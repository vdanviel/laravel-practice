<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

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
        $shoopings = app()->call([$cart_controller, 'show']);

        $product_controller = app()->make(ProductController::class);

        //produtos comprados
        $products = app()->call([$product_controller, 'cart_products'],['array' => $shoopings]);

        return view('cart',compact('products'));

    }else{
        return redirect()->route('login');
    }

})->name('cart');