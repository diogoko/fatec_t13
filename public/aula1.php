<pre>
<?php


// TODO: criar a classe Calculadora


$array = [
    ['nome' => 'diogo', 'cidade' => 'rio preto', 'idade' => 37],
    ['nome' => 'zé', 'cidade' => 'mirassol', 'idade' => 25],
];

$calculadora = new Calculadora($array);
$media = $calculadora->media();
echo "media de idade: $media";

?>
</pre>
