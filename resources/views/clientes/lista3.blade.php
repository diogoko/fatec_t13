@extends('layout')

@section('conteudo')
    @if (session()->has('mensagem'))
    <div class="alert alert-success">{{session()->get('mensagem') }}</div>
    @endif

    <p>
        <a href="{{  route('ClientesNovo') }}" class="btn btn-primary">Criar</a>
    </p>

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
                <th>Idade</th>
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
                    <td>{{ $cliente->nascimento->format('d/m/Y') }}</td>
                    <td>
                        @if ($cliente->cidade)
                            {{ $cliente->cidade->nome }} - {{ $cliente->cidade->estado }}

                            @if ($cliente->cidade->pais)
                                - {{ $cliente->cidade->pais->nome }}
                            @endif
                        @endif
                    </td>
                    <td>
                        {{ $cliente->idadeFormatada }} ({{ $cliente->idadeAnos }} anos)
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h3>HTML de paginação método links()</h3>

    <div>
        {{ $clientes->links() }}
    </div>

    <h3>HTML de paginação manual</h3>

    <div>
        <p>Mostrando {{ $clientes->count() }} itens na página {{ $clientes->currentPage() }} de {{ $clientes->lastPage() }}</p>
        <p>
            <a href="{{ $clientes->previousPageUrl() }}">Anterior</a>
        </p>
        <p>
            <a href="{{ $clientes->nextPageUrl() }}">Próxima</a>
        </p>
        @for ($pagina = 1; $pagina <= $clientes->lastPage(); $pagina++)
            <p>
                <a href="{{ $clientes->url($pagina) }}">
                    Página {{ $pagina }}
                </a>
            </p>
        @endfor
    </div>
@endsection


@section('titulo', 'Lista de clientes')
