<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientesController2 extends Controller
{
    public function listar(Request $request) {
        $consulta = DB::table('clientes');

        $anterior2000 = $request->boolean('anterior2000');
        // TODO: implementar filtro por nascimento

        $filtroNome = $request->nome;
        if ($filtroNome) {
            $consulta->where('nome', 'like', "%$filtroNome%");
        }
        $consulta->orderBy('nome');

        $clientes = $consulta->get();

        logger()->info('cheguei até aqui');
        logger('achei ' . count($clientes) . ' clientes');
        return view('clientes.lista', [
            'clientes' => $clientes,
            'nome' => $filtroNome,
            'anterior2000' => $anterior2000,
        ]);
    }

    public function inserir(Request $request) {
        $request->validate([
            'nome' => 'required|max:200',
            'nascimento' => 'required|date',
        ]);

        $nome = $request->nome;
        $nascimento = $request->nascimento;

        //DB::insert("insert into aula1.clientes (nome, nascimento) values (?, ?)",
        //    [$nome, $nascimento]);

        DB::insert("insert into aula1.clientes (nome, nascimento) values (:nome, :nascimento)",
            ['nome' => $nome, 'nascimento' => $nascimento]);

        $agora = Carbon::now();
        $nascimentoCarbon = new Carbon($nascimento);

        // A opção CarbonInterface::DIFF_ABSOLUTE tira o sufixo ("antes", "depois", etc.)
        $idade = $agora->diffForHumans($nascimentoCarbon, \Carbon\CarbonInterface::DIFF_ABSOLUTE);

        return view('clientes.resultado', [
            'nome' => $nome,
            'nascimento' => $nascimento,
            'idade' => $idade,
        ]);
    }

}
