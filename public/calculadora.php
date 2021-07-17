<?php

namespace MercadoLivre\Pagamento\CartaoCredito;

interface CalculadoraCompleta {
    function soma();
    function media();
}

class Calculadora {
    public static $teste = 123;

    public static function teste() {
        return 'teste ok';
    }

    protected $registros;

    public function __construct($registros) {
        $this->registros = $registros;
    }

    public function media() {
        $idades = array_column($this->registros, 'idade');
        // corresponde a $idades = [25, 24];

        $total = 0;
        foreach ($idades as $idade) {
            $total = $total + $idade;
        }

        return $total / count($idades);
    }
}

class CalculadoraMelhor extends Calculadora implements CalculadoraCompleta {
    public function soma() {
        $idades = array_column($this->registros, 'idade');
        return array_sum($idades);
    }
}
