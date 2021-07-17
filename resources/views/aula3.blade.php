<p>teste aula 3</p>

<p>nome: {{ $nome }}</p>

<form method="post" action="resultado">
    @csrf
    <div>numero <input name="numero"/></div>

    <input type="submit" value="Enviar"/>
</form>

<a href="{{ route('CalculadoraSoma', ['num1' => '1234', 'num2' => 10]) }}">
    Clique aqui para somar
</a>
