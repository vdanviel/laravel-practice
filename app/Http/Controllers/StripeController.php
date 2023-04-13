<?php

namespace App\Http\Controllers;

use App\Mail\PaymentConfirmation;
use App\Models\Order;
use App\Models\Bought;
use App\Models\Cart;
use App\Models\Shopping;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Ramsey\Uuid\Type\Decimal;
use \Stripe\StripeClient;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class StripeController extends Controller
{

    public function index(){

    }

    public function checkout(){
        //tquq-vsaj-rhtu-diln-zkvf - CÓDIGO DE BACKUP

        //objeto do Stripe, que vai se basear na chave API secreta (https://dashboard.stripe.com/test/apikeys)
        //aqui eu coloquei a secret key no .env para segurança
        $stripe = new StripeClient(env('STRIPE_SECRET_KEY'));

        //chamando os produtos que estão no carrinho
        $products = (new ProductController)->cart_products();

        $line_items = [];//var que vai acumular produtos

        //se não houver produtos 
        if (empty($products)) {
            //aciona o cancelamento
            return view('checkout.cancel')->with(['error' => 'Este carrinho está desatualizado.']);
        }

        //acumulando produtos na var com padrão stripe..
        foreach ($products['products'] as $key => $product) {
            //dados dos produtos
            $line_items[] = [
                
                //dados de preço
                'price_data' =>[
                    'currency' => 'BRL',//moeda

                    //dados do produto
                    'product_data' => 
                    [
                        //nome do produto
                        'name' => $product['product_name'],
                        //descrição do produto
                        'description' => $product['product_description']
                    ],

                    'unit_amount' => $product['product_price'] * 100,//preço - * 100 pq o stripe aceita preços somente por centavos
                ],
                
                //quantidade do produto
                'quantity' => $product['shopping_qnt'],

            ]; 
        }

        //criando um obj costumer no stripe
        $customer = $stripe->customers->create([
            "name" => auth()->user()->user_name,
            "email" => auth()->user()->user_email,
        ]);

        //criando a pagina e sessão..
        $checkout_session = $stripe->checkout->sessions->create([
                //esta é a lista de produtos
                'line_items' => $line_items,
                //modo de pagamento
                'mode' => 'payment',
                //inserindo o costumer dentro da session
                'customer' => $customer,
                //url caso sucesso
                'success_url' => route('checkout.success', [], true)."?session_id={CHECKOUT_SESSION_ID}",
                //url caso erro
                'cancel_url' => route('checkout.cancel', [], true)."?session_id={CHECKOUT_SESSION_ID}",
        ]);

        return redirect($checkout_session->url);
    }

    public function success(Request $request){


                
                //setando o objeto stripe
                $stripe = new StripeClient(env('STRIPE_SECRET_KEY'));

                //session info
                $session = $stripe->checkout->sessions->retrieve($request->session_id);

                //client info
                $customer = $stripe->customers->retrieve($session->customer);

                //se a session não existir
                if (!$session) {
                    //404
                    throw new NotFoundHttpException;
                }

                //criando o pedido
                //chamando os produtos que estão no carrinho
                $products = (new ProductController)->cart_products();

                //registrando o pedido no banco de dados (tb_orders)
                $order = new Order;
                $order->order_status = "pendente";
                $order->order_user = auth()->user()->user_id;
                $order->order_total_price = $products['totals']['total_price'];
                $order->order_session_id = $session->id;
                $order->save();

                $order = Order::where('order_session_id', $session->id)->first();

                //mudando pedido para pago
                if ($order->order_status == 'pendente') {
                    $order->order_status = 'pago';
                    $order->save();
                    
                    Mail::to($customer->email)->send(new PaymentConfirmation($session, $order));
                }

                //salvando as compras (tb_boughts)
                //produtos
                $products = (new ProductController)->cart_products();

                //se os produtos não existirem
                if (!$products) {
                    //404
                    throw new NotFoundHttpException;
                }

                foreach ($products['products'] as $key => $product) {
                    
                    $bought = new Bought;

                    $bought->bought_user = auth()->user()->user_id;
                    $bought->bought_product = $product['product_id'];
                    $bought->bought_qnt = $product['shopping_qnt'];
                    $bought->bought_order = $order->order_id;
                    $bought->save();

                } 

                //carrinho que esta sendo usado
                $cart_used = Cart::where('cart_user', auth()->user()->user_id)->first();

                //excluindo as shoppings (itens dentro do carrinho)
                $deleted_shoppings = Shopping::where('shopping_cart', $cart_used->cart_id);
                if($deleted_shoppings->exists()) $deleted_shoppings->delete();

                //excluindo o carrinho usado
                $cart_used = Cart::where('cart_user', auth()->user()->user_id);
                if($cart_used->exists()) $cart_used->delete();

                return view('checkout/success', compact('customer'));
           
    }

    public function cancel(){

        //redirecionando pra o carrinho
        return redirect()->route('cart')->with(['error' => 'O pedido foi cancelado.']);

    }

    //webhook que aconteceria um site real caso o usuario fechasse a tela ou ou o algo acontecesse então o webhook é acionado
    public function webhook(){

        // This is your Stripe CLI webhook secret for testing your endpoint locally.
        $endpoint_secret = env('STRIPE_WEBHOOK_SECRET_KEY');

        $payload = @file_get_contents('php://input');
        $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
        $event = null;

        try {
            $event = \Stripe\Webhook::constructEvent(
                $payload, $sig_header, $endpoint_secret
            );
        } catch (\UnexpectedValueException $e) {
            // Invalid payload
            return response('', 400);
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            // Invalid signature
            return response('', 400);
        }

        // Handle the event
        switch ($event->type) {
            case 'checkout.session.completed':
                $session = $event->data->object;

                $order = Order::where('order_session_id', $session->id)->first();

                if (!$order) {
                    //404
                    throw new NotFoundHttpException;
                }

                if ($order->order_status == 'pendente') {
                    $order->order_status = 'pago';
                    $order->save();
                    
                    Mail::to($session->customer_details->email)->send(new PaymentConfirmation($session, $order));
                }

            // ... handle other event types
            default:
                echo 'Received unknown event type ' . $event->type;
        }

        return response('', 200);

    }


}
