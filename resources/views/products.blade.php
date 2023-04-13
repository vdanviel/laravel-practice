@extends('layout')

@section('title',"Produtos cadastrados ;)")
    
@section('content')

    <!--name price image -->
      <div class="container text-center" >
        <div class="row justify-content-center text-center">

            @foreach ($products_data as $item)
                <div class="col-3 m-2 border rounded-3 p-2">
                    <img style="width: 10rem" src="{{$item['product_image']}}" class="img-fluid mb-1" alt="Your Image">
                    <div>
                        <h5 class="card-title mb-1 px-2">{{$item['product_name']}}</h5>
                        <p class="card-text bold mb-1">R${{$item['product_price']}}</p>
                        <a class="btn btn-primary p-2" href="produtos/{{$item['product_uri']}}">Detalhes</a>
                    </div>
                </div>
            @endforeach       

            {{$products_data->links('custom/pagination')}}
        </div>
      </div>


@endsection