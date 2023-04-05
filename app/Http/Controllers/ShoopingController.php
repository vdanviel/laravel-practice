<?php

namespace App\Http\Controllers;

use App\Models\Shopping;
use Illuminate\Http\Request;

class ShoopingController extends Controller{

    public function index()
    {
        return Shopping::all();
    }

    //adiciona quantidade ao shopping
    public function addqnt($idshopping){
        
        $shop = Shopping::find($idshopping);

        //se esse não shopping existir..
        if (empty($shop)) {
            //retorne com erro
            return redirect()->route('cart')->with(['error' => 'Produto não existe ou foi apagado']);
        }else{
            //se existir

            //se a quantidade for maior q 10
            if ($shop->shopping_qnt >= 10) {

                //retorne com erro
                return redirect()->route('cart')->with(['error' => 'A quantidade do produto não pode passar de 10.']);
    
            }else{

                //se não..

                //atualize a quantidade pra +1
                $shop->update(
                    [
                        'shopping_qnt' => $shop->shopping_qnt + 1
                    ]
                );
                
                //e volte pra o carrinho
                return redirect()->back();
            }

        }
        
    }

    //remove quantidade do shopping
    public function removeqnt($idshopping){

        $shop = Shopping::find($idshopping);

        //se esse não shopping existir..
        if (empty($shop)) {
            //retorne com erro
            return redirect()->route('cart')->with(['error' => 'Produto não existe ou foi apagado']);
        }else{
            //se existir

            //se a quantidade for igual a 1
            if ($shop->shopping_qnt <= 1) {

                //retorne com erro
                return redirect()->route('cart')->with(['error' => 'Você deve comprar no minimo um produto.']);
    
            }else{

                //se não..

                //atualize a quantidade pra -1
                $shop->update(
                    [
                        'shopping_qnt' => $shop->shopping_qnt - 1
                    ]
                );
                
                //e volte pra o carrinho
                return redirect()->back();
            }

        }

    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Shopping $shopping)
    {
        //
    }

    public function edit(Shopping $shopping)
    {
        //
    }

    public function update(Request $request, Shopping $shopping)
    {
        //
    }

    public function destroy(Shopping $shopping)
    {
        //
    }
}
