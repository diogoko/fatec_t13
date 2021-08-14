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
        $editando ?
            route('ClientesAlterar', ['cliente' => $cliente->id])
            : route('ClientesResultado')
    }}" method="post">
        @csrf
        <div>
            <input type="text" name="nome" value="{{ old('nome') ?? $cliente->nome ?? '' }}">
            @error('nome')
                A mensagem de erro é: {{$message}}
            @endif
        </div>
        <div>
            <input name="nascimento" type="date" value="{{
                old('nascimento')
                ?? ($cliente->nascimento ? $cliente->nascimento->toDateString() : '')
                ?? ''
            }}">
            @error('nascimento')
            A mensagem de erro é: {{$message}}
            @endif
        </div>
        <div>
            <select name="cidade_id">
                <option></option>

                @foreach ($cidades as $cidade)
                    <option
                        value="{{ $cidade->id }}"
                        @if ($cidade->id == $cliente->cidade_id)
                            selected
                        @endif
                    >
                        {{ $cidade->nome }} - {{ $cidade->estado }}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <input type="text" placeholder="CEP" onblur="buscarCep2()" id="cep">
        </div>
        <div>
            <input type="text" placeholder="Logradouro" id="logradouro">
        </div>
        <div>
            <input type="text" placeholder="Bairro" id="bairro">
        </div>
        <div>
            <input type="text" placeholder="Municipio" id="municipio">
        </div>
        <div>
            <input type="submit" value="Salvar">
        </div>
    </form>

    <script>
        async function buscarCep() {
            const cep = document.getElementById('cep').value;
            if (!cep) {
                return;
            }

            const response = await fetch(`https://viacep.com.br/ws/${cep}/json`);
            if (response.status === 200) {
                const dados = await response.json();
                if (dados.erro) {
                    alert('CEP não encontrado');
                } else {
                    document.getElementById('logradouro').value = dados.logradouro;
                    document.getElementById('bairro').value = dados.bairro;
                    document.getElementById('municipio').value = dados.localidade;
                }
            } else {
                alert('CEP inválido');
            }
        }

        async function buscarCep2() {
            const cep = document.getElementById('cep').value;
            if (!cep) {
                return;
            }

            const response = await fetch(`{{route('ClientesBuscarCep')}}?cep=${cep}`);
            if (response.status === 200) {
                const dados = await response.json();
                if (dados.erro) {
                    alert(dados.erro);
                } else {
                    document.getElementById('logradouro').value = dados.logradouro;
                    document.getElementById('bairro').value = dados.bairro;
                    document.getElementById('municipio').value = dados.localidade;
                }
            } else {
                alert('Erro inesperado');
            }
        }
    </script>
@endsection

@section('titulo')
    Cadastro de Cliente
@endsection
