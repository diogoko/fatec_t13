@extends('layout')

@section('conteudo')
    @auth
    <p>
        <a href="{{  route('CidadesNovo') }}" class="btn btn-primary">{{ __('cidades.criar') }}</a>
    </p>
    @endauth

    <form action="{{ route('CidadesListar') }}" method="get">
        <div>
            <label>{{ __('cidades.nome') }}</label>
            <input type="text" name="nome" value="{{ $nome }}">
        </div>

        <div><input type="submit" value="Pesquisar"></div>
    </form>

    <p>{{ trans_choice('cidades.quantidade', $cidades->count()) }}</p>

    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Nome</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cidades as $cidade)
                <tr>
                    <td>{{ $cidade->id }}</td>
                    <td>
                        <a href="{{ route('CidadesEditar', ['cidade' => $cidade->id]) }}">
                            {{ $cidade->nome }}
                        </a>
                    </td>
                    <td>{{ __('cidades.local', ['estado' => $cidade->estado]) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection


@section('titulo', 'Lista de cidades')
