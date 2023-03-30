<!DOCTYPE html>
<html class="h-100" lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand" href="/usuarios">Some practice &#128170;</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
          <a @if(Route::current()->uri() == 'usuario') class="nav-link active" @else class="nav-link" @endif href="/usuario">Usuário</a>
          <a @if(Route::current()->uri() == 'produtos') class="nav-link active" @else class="nav-link" @endif href="/produtos">Produtos</a>
          <a @if(Route::current()->uri() == 'carrinhos') class="nav-link active" @else class="nav-link" @endif href="/carrinhos">Carrinho</a>
          <a class="nav-link" onclick="return confirm('Você realmente deseja sair da aplicação?')" href="/logout">Sair</a>
        </div>
      </div>
    </div>
  </nav>

<body class="h-100">
    @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>