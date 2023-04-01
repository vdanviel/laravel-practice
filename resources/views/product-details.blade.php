@extends('layout')

@section('title',$product['product_name'])

@section('content')

<div class="container text-center">
    <div class="row d-flex justify-content-center">

        <span class="d-inline-flex justify-content-center m-2 mt-4">
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-bag-fill" viewBox="0 0 16 16">
                <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5z"/>
            </svg>
            &nbsp;&nbsp;
            <h1>Informações do Produto</h1>
        </span>

        <img class="m-2 mb-3" style='width:30rem' src="{{$product['product_image']}}" alt="Imagem do produto">

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
                
            </div>
        </div>

    </div>
</div>

@endsection