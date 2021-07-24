<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo')</title>
</head>
<body>
    <header>
        <h1>
            <img src="{{ asset('imagens/cachorrinho.jpg') }}" alt="" style="width: 50px;">
            <h1>@yield('titulo')</h1>
        </h1>

        <div style="border-top: 1px solid blue; border-bottom: 1px solid blue; margin: 20px 0; font-weight: bold; font-size: larger;">
            <a href="{{ route('ClientesListar') }}">Clientes</a>
            <a href="{{ route('CidadesListar') }}">Cidades</a>
        </div>
    </header>

    @yield('conteudo')
</body>
</html>
