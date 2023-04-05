<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
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

    //retorna o array dos produtos do carrinho do user atual a partir dos ids das compras (tb_shoppings)
    public function cart_products($shoppings){

        //acumulando os dados puras (junto com as informações Models) em $product_obj_data
        $product_obj_data = array();

        foreach ($shoppings as $key => $value) {

            array_push($product_obj_data, $this->show($shoppings[$key]['shopping_product']));

        }

        /*acumulando somente os dados dos produtos dentro dos 
        objetos models ($product_obj_data) em $products_array*/
        $products_array = array();

        foreach ($product_obj_data as $key => $value) {

            array_push($products_array, $product_obj_data[$key][0]->toArray());

        }

        //pra cada registro, irei colocar:
        //id da compra (shopping_id)
        //a quantidade de compra (shopping_qnt)
        foreach ($products_array as $key => $value) {
            $products_array[$key]['shopping_id'] = $shoppings[$key]['shopping_id'];
            $products_array[$key]['shopping_qnt'] = $shoppings[$key]['shopping_qnt'];
        }

        return $products_array;

    }   

    /**
     * Display the specified resource.
     */
    //show all the product by the product id
    public function show($id){

        return Product::where('product_id', $id)->get();

    }

    //show the product by the product slug
    public function slug($slug, Product $product){

        return $product->where('product_uri', $slug)->first()->toArray();

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
