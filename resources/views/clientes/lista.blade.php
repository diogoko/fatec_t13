@extends('layout')

@section('conteudo')
    <form action="{{ route('ClientesListar') }}" method="get">
        <div>
            <label>Nome</label>
            <input type="text" name="nome" value="{{ $nome }}">
        </div>
        <div>
            <label>
                <input type="checkbox" name="anterior2000"
                    @if ($anterior2000)
                        checked
                    @endif
                >
                Nascidos antes de 2000
            </label>
        </div>

        <div><input type="submit" value="Pesquisar"></div>
    </form>

    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Nome</th>
                <th>Nascimento</th>
                <th>Cidade</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($clientes as $cliente)
                <tr>
                    <td>{{ $cliente->id }}</td>
                    <td>
                        <a href="{{ route('ClientesEditar', ['cliente' => $cliente->id]) }}">
                            {{ $cliente->nome }}
                        </a>
                    </td>
                    <td>{{ $cliente->nascimento }}</td>
                    <td>
                        @if ($cliente->cidade)
                            {{ $cliente->cidade }} - {{ $cliente->estado }}
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection


@section('titulo', 'Lista de clientes')
