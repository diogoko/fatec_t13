@extends('layout')

@section('conteudo')
    @if ($errors->any())
        <div style="color: red; font-weight: bold; margin: 2em 0; border: 2px solid darkred;">
            @foreach ($errors->all() as $erro)
                <p>{{$erro}}</p>
            @endforeach
        </div>
    @endif

    <form action="{{
        route('LoginVerificar')
    }}" method="post">
        @csrf
        <div>
            <input type="text" name="email" value="{{ old('email') ?? '' }}" placeholder="Email">
            @error('email')
                A mensagem de erro é: {{$message}}
            @endif
        </div>
        <div>
            <input type="text" name="senha" value="{{ old('senha') ?? '' }}" placeholder="Senha">
            @error('senha')
                A mensagem de erro é: {{$message}}
            @endif
        </div>
        <div>
            <input type="submit" value="Entrar">
        </div>
    </form>
@endsection

@section('titulo')
    Cadastro de Cliente
@endsection
