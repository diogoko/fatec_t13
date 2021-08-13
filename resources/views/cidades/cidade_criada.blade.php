<h1>Cidade Criada: {{$cidade->nome}}</h1>

<p>
    O usuário {{ auth()->user()->name }} acabou de criar,
    às {{ $cidade->created_at->format('H:i') }} do dia {{ $cidade->created_at->format('d/m/Y') }},
    uma nova cidade chamada "{{ $cidade->nome }}".
</p>
