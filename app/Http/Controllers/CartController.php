<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Shopping;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function index(){
        //
    }

    //retorna o carrinho do usuario (se não existir ele cria e retorna)
    public function createcart(){
        
        //conferindo se já existe um carrinho no nome desse usuario
        $cart = Cart::select()->where("cart_user", auth()->user()->user_id)->first()->toArray();

        if (empty($cart)) {
            //não existe (criando)

            $new_cart = Cart::create(array(
                "cart_user" => auth()->user()->user_id
            ));

            return $new_cart->toArray();

        }else {
            //existe
            return $cart;
        }

    }

    //adiciona produto ao determinado carrinho
    public function cartaddproduct($idproduct){


        //SE A SHOPPING JÁ EXISTIR
        //shoppings que estão no carrinho deste usuario
        $shoppings = Shopping::select()->where("shopping_cart", $this->createcart()['cart_id'])->get()->toArray();

        //valida se shopping existe no final do processo (aqui ainda n existe)
        $shopping_exists = false;

        //analizando todos os shoppings criados
        foreach ($shoppings as $key => $shop) {

            //se já existe um shopping com a tentativa de compra existente +1 na quantidade
            if ($shoppings[$key]['shopping_product'] == $idproduct) {

                //objeto do shopping especifico
                $shop_obj = Shopping::find($shop['shopping_id']);

                //se a quantidade é maior do que 10: erro
                if ($shop_obj->shopping_qnt >= 10) {

                    return redirect()->route('cart')->with(['error' => 'A quantidade do produto não pode passar de 10.']);

                }else{
                    //se a quantidade estiver dentro do limite

                    //atualizando a quantidade desse shop
                    $shop_obj->update([
                        'shopping_qnt' => $shop_obj->shopping_qnt + 1
                    ]);

                    //shopping existe
                    $shopping_exists = true;

                    return redirect()->route('cart');
                }

            }

        }

        //SE A SHOPPING NÃO EXISTIR
        if ($shopping_exists == false) {
            
            $shop = Shopping::create([
                'shopping_cart' => $this->createcart()["cart_id"],
                'shopping_product' => $idproduct,
                'shopping_qnt' => 1
            ]);

            return redirect()->route('cart');
        }
        

    }

    //remove produto do determinado carrinho
    public function cartremoveproduct($idshopping){

        $shop = Shopping::find($idshopping);

        //registro já foi apagado / não existe
        if (empty($shop)){
            return redirect()->route('cart')->with(['error' => 'Produto foi já apagado do carrinho.']);
        }else{
            $shop->delete();
            return redirect()->route('cart');
        }
        
    }

    public function show(Cart $cart){
        //carrinho objeto
        $cart_obj = $cart->byUser(auth()->user()->user_id);    

        //id do carrinho
        $idcart = $cart_obj->cart_id;
    
        //array das compras do usuario objeto (o registro da compra)
        $shoopings = Shopping::byCart($idcart);

        return $shoopings->toArray();   

    }

    public function edit(Cart $cart){
        //
    }

    public function update(Request $request, Cart $cart){
        //
    }

    public function destroy(Cart $cart){
        //
    }
}
