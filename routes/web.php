<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ShoopingController;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
})->name('home');

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
Route::get('/carrinhos', function(){

    if (auth()->check()) {

        $cart_controller = app()->make(CartController::class);

        //compras do carrinho do user
        $shoppings = app()->call([$cart_controller, 'show']);

        $product_controller = app()->make(ProductController::class);

        //produtos comprados
        $products = app()->call([$product_controller, 'cart_products'],['shoppings' => $shoppings]);

        //somando todos os valores para o preço total e somando a quantidade de produtos comprados
        $total_price = 0;
        $total_qnt = 0;

        foreach($products as $key => $product){
            $total_price += $product['product_price'] * $product['shopping_qnt'];
            $total_qnt += $product['shopping_qnt'];
        }

        return view('cart',compact('shoppings','products', 'total_price', 'total_qnt'));

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

#deletar um shopping do carrinho
Route::get('/delete-from-cart/{shopping_id}', [CartController::class, 'cartremoveproduct']);

#adicionar uma quantidade ao shopping
Route::get('/cart/addqnt/{idproduct}', [ShoopingController::class, 'addqnt']);

#retirar uma quantidade ao shopping
Route::get('/cart/removeqnt/{idproduct}', [ShoopingController::class, 'removeqnt']);