<?php

//class MercadoLivre_Pagamento_CartaoCredito_Cielo {
//
//}

require_once 'calculadoras.php';

use MercadoLivre\Pagamento\CartaoCredito\CalculadoraMelhor as C;

$r = [
    ['nome' => 'jose', 'idade' => 25],
    ['nome' => 'maria', 'idade' => 24],
];

//echo Calculadora::$teste . "<br/>";

//CalculadoraMelhor::$teste = 10;
//echo CalculadoraMelhor::$teste . "<br/>";
//echo CalculadoraMelhor::teste() . "<br/>";

//$calculadora = new Calculadora($r);
$calculadora2 = new C([['idade' => 100], ['idade' => 30]]);
$media = $calculadora2->media();
echo $media . "<br/>";
echo $calculadora2->soma() . "<br/>";

//var_export([10, 20, 30]);

?>
<pre>
<?php
//var_export($_GET);
//var_export($_POST);
//var_dump($_SERVER);

echo "o método usado para esta requisição foi " . $_SERVER['REQUEST_METHOD'];

?>
</pre>







