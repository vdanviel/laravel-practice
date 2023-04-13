<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    //retorna o array dos produtos dos shoppings do usuario atual
    public function cart_products(){

        //shoppings do usuario
        $shoppings = (new CartController)->show();

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
        //o preço TOTAL da compra
        //a quantidade TOTAL da compra

        $total_price = 0;
        $total_qnt = 0;
        foreach ($products_array as $key => $product) {
            $products_array[$key]['shopping_id'] = $shoppings[$key]['shopping_id'];
            $products_array[$key]['shopping_qnt'] = $shoppings[$key]['shopping_qnt'];

            $total_price += $products_array[$key]['product_price'] * $products_array[$key]['shopping_qnt'];

            $total_qnt += $products_array[$key]['shopping_qnt'];
        }

        $total_array = [
            "total_price" => $total_price,
            "total_qnt" => $total_qnt
        ];

        //retorna
        if (empty($products_array)) {
            return [];
        }else{

            return [
                //produtos do carrinho
                "products" => $products_array,
                //preço total, e quantidade de produtos total
                "totals" => $total_array
            ];

        }

    }   

    //show all the product by the product id
    public function show($id){

        return Product::where('product_id', $id)->get();

    }

    //show the product by the product slug
    public function slug($slug, Product $product){

        return $product->where('product_uri', $slug)->first()->toArray();

    }

    public function edit(Product $product)
    {
        //
    }

    public function update(Request $request, Product $product)
    {
        //
    }

    public function destroy(Product $product)
    {
        //
    }
}
