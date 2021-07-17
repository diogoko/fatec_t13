<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CalculadoraController;
use App\Http\Controllers\ClientesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/aula3/{nome?}', function (Request $request, $nome = 'Nome Padrão') {
    //$nome = $request->input('n') ?? 'nome padrão';
    return view('aula3', ['nome' => $nome]);
})->name('Aula3');


Route::post('/resultado', function (Request $request) {
    $resultado = $request->input('numero') / 2;
    return view('aula3.resultado', ['r' => $resultado]);
});


Route::get('/', function (Request $request) {
    return view('welcome', ['x' => $request->input('x')]);
});

Route::view('/calculadora', 'calculadora.form');

Route::post('/calculadora/resultado', [CalculadoraController::class, 'resultado'])->name('CalculadoraResultado');

$rota = Route::get('/calculadora/soma/{num1}/{num2}', [CalculadoraController::class, 'soma']);
$rota->name('CalculadoraSoma');

Route::get('/clientes', [ClientesController::class, 'listar']);
Route::view('/clientes/novo', 'clientes.formulario');
Route::post('/clientes/novo', [ClientesController::class, 'inserir'])->name('ClientesResultado');
