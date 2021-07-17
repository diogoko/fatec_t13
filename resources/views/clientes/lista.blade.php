@extends('clientes.layout')

@section('conteudo')
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Nome</th>
                <th>Nascimento</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($clientes as $cliente)
                <tr>
                    <td>{{ $cliente->id }}</td>
                    <td>{{ $cliente->nome }}</td>
                    <td>{{ $cliente->nascimento }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection


@section('titulo', 'Lista de clientes')
