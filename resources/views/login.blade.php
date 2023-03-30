<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login - Some practice &#128170;</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body class="bg-light h-100">
    <div class="container d-flex justify-content-center h-100">
        <div class="row w-30 align-content-center">
            <div class="col">
                <h1 class="mb-5">Some practice &#128170;</h1>

                @if($errors->any())

                    @component('component/alert-danger')
                        @slot('erro'){{$errors->first('erro')}}@endslot
                    @endcomponent 
    
                @endif

                <form method="POST" action="{{route('login')}}">
                        @csrf

                        <div class="mb-3">
                        <label for="InputEmail1" class="form-label">Qual e-mail você registrou aqui?</label>
                        <input type="email" name='email' class="form-control" id="InputEmail1" aria-describedby="emailHelp">
                        <div id="emailHelp" class="form-text">Seu email não será compartilhado ocm ninguém.</div></div>
            
                        <div class="mb-3">
                        <label for="InputPassword1" class="form-label">Qual é a sua senha?</label>
                        <input type="password" name='password' class="form-control" id="InputPassword1">
                        </div>
                            
                        <button type="submit" class="btn btn-primary mb-1">Entrar</button>
                  </form>
                  <a href="/registre-se">Registrar-se</a>
            </div>

        </div>
    </div>

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>