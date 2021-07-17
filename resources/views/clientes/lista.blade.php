@extends('clientes.layout')

@section('conteudo')
    @foreach ($clientes as $cliente)
    <div>
        <p>Nome</p>
        <p>{{ $cliente->nome }}</p>
    </div>
    <div>
        <p>Nascimento</p>
        <p>{{ $cliente->nascimento }}</p>
    </div>
    @endforeach
@endsection


@section('titulo', 'Lista de clientes')
