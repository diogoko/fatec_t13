<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo') - Cadastro de Cidades</title>
</head>
<body>
    <h1>
        <img src="{{ asset('imagens/cachorrinho.jpg') }}" alt="" style="width: 50px;">
        Cadastro de Cidades
    </h1>

    <h2>@yield('titulo')</h2>

    @yield('conteudo')
</body>
</html>
