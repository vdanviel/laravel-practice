@extends('layout')

@section('title', 'Seu Perfil')

@section('content')

        <div class="container d-flex justify-content-center align-content-center">

            <div class="row d-flex flex-column justify-content-center align-content-center">
                
                <span class="text-center p-0 m-2">
                    @if(session('register_success'))
                        @component('component/alert-success')
                            @slot('message')
                                {{session('register_success')}}
                            @endslot
                        @endcomponent
                    @endif
                </span>

                <svg class="mb-4 mt-4" xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                    <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                </svg>
    
                <div class="col w-100 p-5 border rounded-3 text-center d-flex flex-column justify-content-center">
    
                    <label for="name">Nome:</label>
                    <p id="name" class="fs-4">{{$user['name']}}</p>
    
                    <label for="email">E-mail:</label>
                    <p id="email" class="fs-4">{{$user['email']}}</p>
    
                    <label for="age">Idade:</label>
                    <p id="age" class="fs-4 mb-0">
                        {{$user['age']}} anos<br>
                        <i class="fs-5">{{$user['birthday']}}</i>
                    </p>
                </div>
    
                <span class="text-center p-0">
                    <a onclick="return confirm('Você realmente deseja sair da aplicação?')" class="btn btn-light mt-3 fs-5" style="width: fit-content" href="/logout"> Sair </a>
                </span>
                
            </div>
        </div>

@endsection