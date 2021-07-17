@extends('clientes.layout')

@section('conteudo')
    <div>
        <p>Nome</p>
        <p>{{ $nome }}</p>
    </div>
    <div>
        <p>Nascimento</p>
        <p>{{ $nascimento }}</p>
    </div>
    <div>
        <p>Idade</p>
        <p>{{ $idade }}</p>
    </div>
@endsection


@section('titulo', 'Resultado da operação')
