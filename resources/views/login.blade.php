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
                  
                  <a href="https://www.github.com/vdanviel" style="margin:20px; color:#242424">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-github" viewBox="0 0 16 16">
                      <path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.012 8.012 0 0 0 16 8c0-4.42-3.58-8-8-8z"/>
                    </svg>
                    vdanviel
                  </a>
            </div>

        </div>
    </div>

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>