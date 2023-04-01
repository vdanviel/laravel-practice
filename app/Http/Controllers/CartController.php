<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Shopping;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        //carrinho objeto
        $cart_obj = $cart->byUser(auth()->user()->user_id);    

        //id do carrinho
        $idcart = $cart_obj->cart_id;
    
        //array das compras do usuario objeto (o registro da compra)
        $shoopings = Shopping::byCart($idcart);

        return $shoopings->toArray();   

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        //
    }
}
