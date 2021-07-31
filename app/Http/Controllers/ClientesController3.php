<?php

namespace App\Http\Controllers;

use App\Models\Cidade;
use App\Models\Cliente;
use Illuminate\Http\Request;

class ClientesController3 extends Controller
{
    public function listar(Request $request) {
        $consulta = Cliente::orderBy('nome');

        $anterior2000 = $request->boolean('anterior2000');
        if ($anterior2000) {
            $consulta->whereYear('nascimento', '<', '2000');
        }

        $filtroNome = $request->nome;
        if ($filtroNome) {
            $consulta->where('nome', 'like', "%$filtroNome%");
        }

        $consulta->with('cidade', 'cidade.pais');
        $clientes = $consulta->get();

        return view('clientes.lista3', [
            'clientes' => $clientes,
            'nome' => $filtroNome,
            'anterior2000' => $anterior2000,
        ]);
    }

    public function novo() {
        return view('clientes.formulario3', [
            'cliente' => new Cliente(),
            'editando' => false,
            'cidades' => Cidade::orderBy('nome')->get(),
        ]);
    }

    public function inserir(Request $request) {
        $request->validate([
            'nome' => 'required|max:200',
            'nascimento' => 'required|date',
            'cidade_id' => 'required|int',
        ]);

        $cliente = new Cliente();
        $cliente->nome = $request->nome;
        $cliente->nascimento = $request->nascimento;
        $cliente->cidade_id = $request->cidade_id;
        $cliente->save();

        logger('ID do novo cliente: ' . $cliente->id);

        return redirect()->route('ClientesListar');
    }

    public function editar(Cliente $cliente) {
        return view('clientes.formulario3', [
            'cliente' => $cliente,
            'editando' => true,
            'cidades' => Cidade::orderBy('nome')->get(),
        ]);
    }

    public function alterar(Request $request, Cliente $cliente) {
        $request->validate([
            'nome' => 'required|max:200',
            'nascimento' => 'required|date',
            'cidade_id' => 'required|int',
        ]);

        $cliente->nome = $request->nome;
        $cliente->nascimento = $request->nascimento;
        $cliente->cidade_id = $request->cidade_id;
        $cliente->save();

        return redirect()->route('ClientesListar');
    }
}
