<?php

use MercadoLivre\Pagamento\CartaoCredito\CalculadoraMelhor;

$nomeClasse = 'calculadora';
require_once $nomeClasse . '.php';

$n1 = $_POST['numero1'];
$n2 = $_POST['numero2'];

$calculadora = new CalculadoraMelhor([
    ['idade' => $n1],
    ['idade' => $n2],
]);

$comando = $_POST['botao'];

if ($comando == 'Soma') {
    $resultado = $calculadora->soma();
} else {
    $resultado = $calculadora->media();
}


/*
if (empty($_POST['botaoMedia'])) {
    // faz a soma
} else {
    // faz a média
}
*/
?>

<p>
<?php echo "O resultado é ${resultado}"; ?>
</p>

<p>
O resultado é <?php echo $resultado; ?>
</p>

<p>
O resultado é <?= $resultado ?>
</p>
