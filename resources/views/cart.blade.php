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

                @if (session('success'))
                    @component('component/alert-success')
                        @slot('message')
                            {{session('success')}}
                        @endslot
                    @endcomponent
                @endif

                @if (empty($products))
                    
                    <div class="d-flex p-4 align-items-center flex-column border rounded-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor" class="bi bi-bag-x-fill" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M10.5 3.5a2.5 2.5 0 0 0-5 0V4h5v-.5zm1 0V4H15v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4h3.5v-.5a3.5 3.5 0 1 1 7 0zM6.854 8.146a.5.5 0 1 0-.708.708L7.293 10l-1.147 1.146a.5.5 0 0 0 .708.708L8 10.707l1.146 1.147a.5.5 0 0 0 .708-.708L8.707 10l1.147-1.146a.5.5 0 0 0-.708-.708L8 9.293 6.854 8.146z"/>
                        </svg>
                        <h4 class="mt-5">Não há produtos no carrinho.</h4>
                    </div>

                @else

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
                        @foreach ($products['products'] as $product)
                            <tr class="text-center align-middle">
                                <th>{{$product['product_id']}}</th>
                                <td><img style="width: 100px" src="{{$product['product_image']}}" alt="{{$product['product_name']}}"></td>
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

                <form action="delete-cart" method="post">
                    @csrf

                    <input class="btn btn-light" type="submit" value="Deletar carrinho">
                </form>

                @endif

            </div>

            <div class="col mt-4 d-flex justify-content-center">

                <div class="flex-column text-center">

                    @if(empty($products))
                        <p class="border p-3 rounded-3 my-1"><b>Preço Total: </b>R$0</p>
                        <p class="border p-3 rounded-3 my-1"><b>Quantidade Total: </b> 0 produtos.</p>
                    @else
                        <p class="border p-3 rounded-3 my-1"><b>Preço Total: </b>R${{number_format($products['totals']['total_price'], 2, ',')}}</p>
                        <p class="border p-3 rounded-3 my-1"><b>Quantidade Total: </b> {{$products['totals']['total_qnt']}} produtos.</p>
                    @endif

                    @if(!empty($products))
                        <form action="/create-checkout-session" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success mt-4 p-3 fs-4">Comprar</button>
                        </form>
                    @endif    
                    
                </div>

            </div>

        </div>
    </div>

@endsection