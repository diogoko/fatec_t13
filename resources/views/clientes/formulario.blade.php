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
        isset($editando) ?
            route('ClientesAlterar', ['cliente' => $id])
            : route('ClientesResultado')
    }}" method="post">
        @csrf
        <div>
            <input type="text" name="nome" value="{{ old('nome') ?? $nome ?? '' }}">
            @error('nome')
                A mensagem de erro é: {{$message}}
            @endif
        </div>
        <div>
            <input name="nascimento" type="date" value="{{ old('nascimento') ?? $nascimento ?? '' }}">
            @error('nascimento')
            A mensagem de erro é: {{$message}}
            @endif
        </div>
        <div>
            <input type="submit" value="Salvar">
        </div>
    </form>
@endsection

@section('titulo')
    Cadastro de Cliente
@endsection
