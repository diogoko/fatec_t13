@extends('calculadora.layout')

@section('conteudo')
    @if ($errors->any())
        <div style="color: red; font-weight: bold; margin: 2em 0; border: 2px solid darkred;">
            @foreach ($errors->all() as $erro)
                <p>{{$erro}}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('CalculadoraResultado') }}" method="post">
        @csrf
        <div>
            <input type="text" name="a" value="{{ old('a') }}">
            @error('a')
                A mensagem de erro é: {{$message}}
            @endif
        </div>
        <div>
            <input name="b" value="{{ old('b') }}">
            @error('b')
            A mensagem de erro é: {{$message}}
            @endif
        </div>
        <div>
            <input type="submit" name="opSoma" value="Sum">
            <input type="submit" name="opMedia" value="Average">
        </div>
    </form>
@endsection

@section('titulo')
    Formulário da calculadora
@endsection
