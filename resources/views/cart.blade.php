@extends('layout')

@section('title','Seu Carrinho')

@section('content')
    <div class="container ">
        <div class="row d-flex">

            <div class="col mt-3 justify-content-center">
                <table class="table">

                    <thead class="table-primary">
                        <tr>
                            <th>#</th>
                            <th>Imagem</th>
                            <th>Nome</th>
                            <th>Preço</th>
                        </tr>
                    </thead>
            
                    <tbody>
            
                        @foreach ($products as $product)
                            <tr>
                                <th>{{$product['product_id']}}</th>
                                <td><img style="width: 100px" src="{{$product['product_image']}}" alt="{{$products[0]['product_name']}}"></td>
                                <td>{{$product['product_name']}}</td>
                                <td>{{$product['product_price']}}</td>
                            </tr>
                        @endforeach
                        
                    </tbody>
                </table>
            </div>

            

        </div>
    </div>

@endsection