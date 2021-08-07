<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
</head>
<body>

<header>
  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#"><img src="{{ asset('imagens/cachorrinho.jpg') }}" alt="" style="width: 50px;"></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav me-auto mb-2 mb-md-0">
          <li class="nav-item">
              <a class="nav-link" href="{{ route('ClientesListar') }}">Clientes</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="{{ route('CidadesListar') }}">Cidades</a>
          </li>
          @guest
          <li class="nav-item">
              <a class="nav-link" href="{{ route('LoginFormulario') }}">Entrar</a>
          </li>
          @endguest
          @auth
          <li class="nav-item">
            <a href="#" class="nav-link">
            {{auth()->user()->name}}
            </a>
        </li>
        @endauth
        </ul>

        @auth
        <form class="d-flex" method="post" action="{{route('LoginLogout')}}">
            @csrf
          <button class="btn btn-link nav-link" type="submit">Sair</button>
        </form>
        @endauth

      </div>
    </div>
  </nav>
</header>

<div class="container" style="margin-top: 90px;">

    @yield('conteudo')
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
</body>
</html>
