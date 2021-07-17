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
        if ($anterior2000) {
            //$consulta->where('nascimento', '<', '2000-01-01');
            $consulta->whereYear('nascimento', '<', '2000');
        }

        $filtroNome = $request->nome;
        if ($filtroNome) {
            $consulta->where(function ($query) use ($filtroNome) {
                $query->orWhere('nome', 'like', "$filtroNome%");
                $query->orWhere('nome', 'like', "%$filtroNome");
                return $query;
            });
        }
        $consulta->orderBy('nome');
        //$consulta->oldest('nascimento');

        //$consulta->limit(3);
        //$consulta->offset(5);

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

        $id = DB::table('clientes')->insertGetId([
            'nome' => $nome,
            'nascimento' => $nascimento,
        ]);

        return redirect()->route('ClientesEditar', ['cliente' => $id]);
    }

    public function editar($id) {
        $cliente = DB::table('clientes')->find($id);

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

        DB::table('clientes')->where('id', $id)->update(compact('nome', 'nascimento'));

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
