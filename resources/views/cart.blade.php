@extends('layout')

@section('title','Seu Carrinho')

@section('content')
    <div class="container ">
        <div class="row d-flex">

            <div class="col mt-3 justify-content-center">

                @if (session('error'))
                    @component('component/alert-danger')
                        @slot('erro')
                            {{session('error')}}
                        @endslot
                    @endcomponent
                @endif

                <table class="table">

                    <thead class="table-primary">
                        <tr class="text-center">
                            <th>#</th>
                            <th>Imagem</th>
                            <th>Nome</th>
                            <th>Quantidade</th>
                            <th>Preço</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
            
                    <tbody>
            
                        @foreach ($products as $product)
                            <tr class="text-center align-middle">
                                <th>{{$product['product_id']}}</th>
                                <td><img style="width: 100px" src="{{$product['product_image']}}" alt="{{$products[0]['product_name']}}"></td>
                                <td>{{$product['product_name']}}</td>
                                <td style="text-align: -webkit-center;">

                                    <a class="btn btn-light p-1" href="/cart/removeqnt/{{$product['shopping_id']}}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dash" viewBox="0 0 16 16">
                                            <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z"/>
                                        </svg>
                                    </a>

                                    {{$product['shopping_qnt']}}

                                    <a class="btn btn-light p-1" href="/cart/addqnt/{{$product['shopping_id']}}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                        </svg>
                                    </a>
                                    
                                </td>
                                <td>{{ number_format($product['product_price'] * $product['shopping_qnt'], 2, ',') }}</td>
                                <td>
                                    <a class="btn btn-light" href="/delete-from-cart/{{$product['shopping_id']}}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                            <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        
                    </tbody>
                </table>
            </div>

            <div class="col mt-4 d-flex justify-content-center">

                <div class="flex-column text-center">
                    <p class="border p-3 rounded-3 my-1"><b>Preço Total: </b>R${{number_format($total_price, 2, ',')}}</p>
                    <p class="border p-3 rounded-3 my-1"><b>Quantidade Total: </b> {{$total_qnt}} produtos.</p>
                    <a class="btn btn-success mt-4 p-3 fs-4" href="/checkout-payment">Comprar</a>
                </div>

            </div>

        </div>
    </div>

@endsection