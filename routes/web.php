<?php

use Illuminate\Http\Request;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\tbUsersController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Models\Product;

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

Route::get('/login', function () {

    if (auth()->check()) {

        return redirect()->route('profile');

    }else{
        return view('login');
    }

})->name('login');

Route::post('/login', [UserController::class, 'login'])->name('auth');

Route::get('registre-se', function () {

    if (auth()->check()) {

        return redirect()->route('profile');

    }else{
        return view('register');
    }
    
})->name('register');

Route::post('registre-se',[UserController::class, 'register']);

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

Route::get('/logout', function () {
    auth()->logout();

    return redirect()->route('home');
})->name('logout');

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
        $product = (new ProductController)->show($slug);

        return view('product-details',compact('product'));
    }else{
        //não autenticado volta pra o login
        return redirect()->route('login');
    }

})->name('product-details');
