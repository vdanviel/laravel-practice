<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CepController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ShoopingController;
use App\Http\Controllers\StripeController;

use App\Models\Cart;
use App\Models\Product;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

Route::get('/', function () {

    return view('welcome');
})->name('home');

Route::view('/mail', 'email/mail-payment');

#REGISTER/LOGIN
Route::get('registre-se', function () {

    if (auth()->check()) {

        return redirect()->route('profile');

    }else{
        return view('register');
    }
    
})->name('register');

Route::post('registre-se',[UserController::class, 'register']);

Route::get('/login', function () {

    if (auth()->check()) {

        return redirect()->route('profile');

    }else{
        return view('login');
    }

})->name('login');

Route::post('/login', [UserController::class, 'login'])->name('auth');

#usuario
Route::get('/usuario', function(){

    if (auth()->check()) {
        //autenticado
        $user = UserController::userinfo();

        return view('profile',compact('user'));   
    }else{
        //não autenticado volta pra o login
        return redirect()->route('login');
    }

})->name('profile');

#logout
Route::get('/logout', function () {
    auth()->logout();

    return redirect()->route('home');
})->name('logout');

#PRODUTOS
Route::get('/produtos', function () {

    if (auth()->check()) {
        //autenticado
        
        $products_data = Product::paginate(6);

        return view('products',compact('products_data'));
    }else{
        //não autenticado volta pra o login
        return redirect()->route('login');
    }
})->name('products');

Route::get('/produtos/{slug}', function($slug){

    if (auth()->check()) {
        //autenticado
        $product_controller = app()->make(ProductController::class);

        $product = app()->call([$product_controller, 'slug'],['slug' => $slug]);

        return view('product-details',compact('product'));
    }else{
        //não autenticado volta pra o login
        return redirect()->route('login');
    }

})->name('product-details');

#CARTS
Route::get('/carrinho', function(){

    if (auth()->check()) {

        $product_controller = app()->make(ProductController::class);

        //produtos comprados
        $products = app()->call([$product_controller, 'cart_products']);

        return view('cart',compact('products'));

    }else{
        return redirect()->route('login');
    }

})->name('cart');

#adicionar um shopping ao carrinho 
Route::get('/add-cart/{idproduct}', function($idproduct){

    if (auth()->check()) {
        //logado

        $cart_controller = app()->make(CartController::class);

        //adiciona shopping ao determinado carrinho
        return $cart_controller->cartaddproduct($idproduct);


    }else {
        //se não logado vai pra o login
        return redirect()->route('login');
    }

});

#carrinho adicionou produto
Route::get('/cart-success', function(Illuminate\Http\Request $request){

    //se eu estiver entrando pelo cartcontroller, onde a session('success') é setada
    if (session('success')) {
        //eu entro

        //desfaço a session para tentantivas futuras
        $request->session()->forget('success');

        return view('success-cart');
    }else {//se eu tentar acessar a pagina independentemente
        //eu não posso entrar
        throw new NotFoundHttpException("A página é restrita.");
    }

})->name('cart-success');

#carrinho deu erro ao adicionar o produto
Route::get('/cart-error', function(Illuminate\Http\Request $request){

    if (session('error')) {

        if ($request->session()->get('error') == "A quantidade do produto não pode passar de 10.") {
            $error = 'A quantidade de produtos não pode passar de 10.';
        }else{
            $error = 'Algo de errado aconteceu.';
        }

        $request->session()->forget('error');

        return view('error-cart',compact('error'));
    }else {
        throw new NotFoundHttpException("A página é restrita.");
    }

})->name('cart-error');

#deletar um shopping do carrinho
Route::get('/delete-from-cart/{shopping_id}', [CartController::class, 'cartremoveproduct']);

#deletar todos os shoppings do carrinho
Route::post('/delete-cart', [CartController::class, 'carterase']);

#adicionar uma quantidade ao shopping
Route::get('/cart/addqnt/{idproduct}', [ShoopingController::class, 'addqnt']);

#retirar uma quantidade ao shopping
Route::get('/cart/removeqnt/{idproduct}', [ShoopingController::class, 'removeqnt']);

#CHECKOUT
//criando a pagina de cheout stripe
//Route::post('/checkout', [ProductController::class, 'checkout'])->name('checkout');
Route::post('/create-checkout-session', [StripeController::class, 'checkout'])->name('checkout');

//operação sucedida
Route::get('/success', [StripeController::class, 'success'])->name('checkout.success');

//operação cancelada
Route::get('/cancel', [StripeController::class, 'cancel'])->name('checkout.cancel');

/*Um webhook é um recurso que permite que uma aplicação web receba automaticamente notificações
ou informações de eventos de outra aplicação web em tempo real.
Eu criei esse webhook para quando o Stripe atualizar a compra o tb_order->tb_status também atualize,
ou seja, o status da compra sempre vai estar de acordo com o status real, que é o do stripe

PARA ISSO PRIMEIRAMENTE DESATIVAR A VALIDADÃO csrf NESSA URL (/stripe/webhook) 
em app/Http/Middleware/VerifyCsrfToken.php*/
Route::post('/stripe/webhook', [StripeController::class, 'webhook'])->name('webhook');