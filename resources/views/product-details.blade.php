@extends('layout')

@section('title',$product['product_name'])

@section('content')

<div class="container text-center">
    <div class="row d-flex justify-content-center">

        <span class="d-inline-flex justify-content-center align-items-center m-2 mt-4">
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-bag-fill" viewBox="0 0 16 16">
                <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5z"/>
            </svg>
            &nbsp;&nbsp;
            <h1>Informações do Produto</h1>
            &nbsp;&nbsp;
            <h1 class="text-muted">#{{$product['product_id']}}</h1>
        </span>

        <img class="m-2 mb-3" style='width:25rem' src="{{$product['product_image']}}" alt="Imagem do produto">

        <div class="col-12">
            <div class="align-items-center">

                <h3>{{$product['product_name']}}</h3>
                <s class="color-info fs-4">R${{$product['product_price'] * 2}}</s>
                <b class="fs-3">R${{$product['product_price']}}</b>
                <h5 class="m-2">Descrição:</h5>
                
                <span class="d-flex justify-content-center">
                    <p class="p-2 border rounded-3 w-50">
                        {{$product['product_description']}}
                    </p>
                </span>

                    <a href="/add-cart/{{$product['product_id']}}" class="btn btn-success fs-5 my-2">
                        <svg class="MuiSvgIcon-root" fill="white" width="50" height="50" focusable="false" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M11 9h2V6h3V4h-3V1h-2v3H8v2h3v3zm-4 9c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zm10 0c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2zm-9.83-3.25l.03-.12.9-1.63h7.45c.75 0 1.41-.41 1.75-1.03l3.86-7.01L19.42 4h-.01l-1.1 2-2.76 5H8.53l-.13-.27L6.16 6l-.95-2-.94-2H1v2h2l3.6 7.59-1.35 2.45c-.16.28-.25.61-.25.96 0 1.1.9 2 2 2h12v-2H7.42c-.13 0-.25-.11-.25-.25z"></path>
                        </svg>
                        Adicionar ao Carrinho
                    </a>

            </div>
        </div>

    </div>
</div>

@endsection