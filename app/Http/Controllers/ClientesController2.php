<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientesController2 extends Controller
{
    public function listar(Request $request) {
        $consulta = DB::table('clientes');

        $consulta->leftJoin('cidades', 'cidades.id', '=', 'cidade_id');

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
        $consulta->orderBy('clientes.nome');
        //$consulta->oldest('nascimento');

        $consulta->select('clientes.*', 'cidades.nome as cidade', 'cidades.estado');

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

    public function novo() {
        return view('clientes.formulario', [
            'editando' => false,
            'cidades' => DB::table('cidades')->orderBy('nome')->get(),
            'cidade_id' => null,
        ]);
    }

    public function inserir(Request $request) {
        $request->validate([
            'nome' => 'required|max:200',
            'nascimento' => 'required|date',
            'cidade_id' => 'required|int',
        ]);

        $nome = $request->nome;
        $nascimento = $request->nascimento;
        $cidade_id = $request->cidade_id;

        $id = DB::table('clientes')->insertGetId([
            'nome' => $nome,
            'nascimento' => $nascimento,
            'cidade_id' => $cidade_id,
        ]);

        return redirect()->route('ClientesListar');
    }

    public function editar($id) {
        $cliente = DB::table('clientes')->find($id);

        return view('clientes.formulario', [
            'id' => $cliente->id,
            'nome' => $cliente->nome,
            'nascimento' => $cliente->nascimento,
            'editando' => true,
            'cidades' => DB::table('cidades')->orderBy('nome')->get(),
            'cidade_id' => $cliente->cidade_id,
        ]);
    }

    public function alterar(Request $request, $id) {
        $request->validate([
            'nome' => 'required|max:200',
            'nascimento' => 'required|date',
            'cidade_id' => 'required|int',
        ]);

        $nome = $request->nome;
        $nascimento = $request->nascimento;
        $cidade_id = $request->cidade_id;

        DB::table('clientes')->where('id', $id)->update(compact('nome', 'nascimento', 'cidade_id'));

        $agora = Carbon::now();
        $nascimentoCarbon = new Carbon($nascimento);

        // A opção CarbonInterface::DIFF_ABSOLUTE tira o sufixo ("antes", "depois", etc.)
        $idade = $agora->diffForHumans($nascimentoCarbon, \Carbon\CarbonInterface::DIFF_ABSOLUTE);

        return redirect()->route('ClientesListar');
    }
}
