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
        return view('clientes.lista', ['clientes' => $clientes, 'nome' => '', 'anterior2000' => false]);
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

    public function editar($id) {
        $clientes = DB::select('select * from aula1.clientes where id = ?', [$id]);
        $cliente = $clientes[0];

        return view('clientes.formulario', [
            'id' => $cliente->id,
            'nome' => $cliente->nome,
            'nascimento' => $cliente->nascimento,
            'editando' => true,
        ]);
    }

    public function alterar(Request $request, $id) {
        $request->validate([
            'nome' => 'required|max:200',
            'nascimento' => 'required|date',
        ]);

        $nome = $request->nome;
        $nascimento = $request->nascimento;

        DB::update("update aula1.clientes set nome = :nome, nascimento = :nascimento where id = :id",
            compact('id', 'nome', 'nascimento'));

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
