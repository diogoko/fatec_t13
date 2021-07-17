<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalculadoraController extends Controller
{
    public function resultado(Request $request) {
        $request->validate([
            'a' => 'required|int',
            'b' => 'required|int',
        ]);

        $a = $request->a;
        $b = $request->b;
        if ($request->opSoma) {
            $resultado = $a + $b;
        } else {
            $resultado = ($a + $b) / 2;
        }

        return view('calculadora.resultado', ['resultado' => $resultado]);
    }

    public function soma($numero1, $numero2) {
        return view('calculadora.resultado', ['resultado' => $numero1 + $numero2]);
    }
}
