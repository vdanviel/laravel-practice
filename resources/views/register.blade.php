<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registre-se - Some practice &#128170;</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body class="bg-light h-100">
    <div class="container d-flex justify-content-center h-100">
        <div class="row w-30 align-content-center">
            <div class="col">
                <h1 class="mb-3">Some practice &#128170;<br><sub style="font-size: 15px">Registre-se neste lindo sistema.</sub></h1>

                <form method="POST" action="{{route('register')}}">
                        @csrf

                        {{--ERROS RELACIONADOS AO DB--}}
                        @if (session('error'))
                            
                            @component('components/alert-danger')
                                @slot('erro')
                                    {{session('error')}}
                                @endslot
                            @endcomponent

                        @endif

                        {{--ERRO RELACIONADO AOS CAMPOS--}}
                        @if($errors->any())

                            @if (count($errors) > 1)
                                @component('component.alert-danger')
                                    @slot('erro')
                                        Mais de um campo está vazio.
                                    @endslot
                                @endcomponent
                            @endif

                            @if(count($errors) == 1)

                                @foreach ($errors->all() as $error)
                                    @component('component.alert-danger')
                                        @slot('erro')
                                            {{$error}}
                                        @endslot
                                    @endcomponent
                                @endforeach

                            @endif

                            
                        @endif

                        <div class="mb-3">
                        <label for="InputName1" class="form-label">Qual o seu nome?</label>
                        <input type="text" name='name' class="form-control" id="InputName1">
                        </div>
                            
                        <div class="mb-3">
                        <label for="InputEmail1" class="form-label">Digite um e-mail aí</label>
                        <input type="email" name='email' class="form-control" id="InputEmail1">
                        </div>

                        <div class="mb-3">
                        <label for="InputBirthday1" class="form-label">Quando você nasceu?</label>
                        <input type="date" min="1900-01-01" max="{{date('Y-m-d')}}" name='birthday' class="form-control" id="InputBrithday1">
                        </div>

                        <div class="mb-3">
                        <label for="InputPassword1" class="form-label">Pense em uma senha para usar</label>
                        <input type="password" name='password' class="form-control" id="InputPassword1">
                        </div>
                            
                        <button type="submit" class="btn btn-primary mb-1">Registrar</button>
                  </form>
            </div>

        </div>
    </div>

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>