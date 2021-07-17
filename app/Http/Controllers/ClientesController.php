<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientesController extends Controller
{
    public function listar() {
        $clientes = DB::select('select * from aula1.clientes');
        logger()->info('cheguei até aqui');
        logger('achei ' . count($clientes) . ' clientes');
        return view('clientes.lista', ['clientes' => $clientes]);
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
