<?php

namespace App\Http\Controllers;

use App\Models\Cidade;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ClientesController3 extends Controller
{
    public function listar(Request $request) {
        // exemplo pegar dados usuario
        $usuario = auth()->user();

        //session()->forget('olá da página de clientes');
        //session()->put('mensagem', 'olá da página de clientes');

        $consulta = Cliente::orderBy('nome');

        $anterior2000 = $request->boolean('anterior2000');
        if ($anterior2000) {
            $consulta->whereYear('nascimento', '<', '2000');
        }

        $filtroNome = $request->nome;
        if ($filtroNome) {
            $consulta->where('nome', 'like', "%$filtroNome%");
        }

        /*
        // Filtragem por tabela relacionada
        $consulta->whereHas('cidade.pais', function ($query) use ($request) {
            $query->where('nome', $request->paisSelecionado);
        });
        */

        $consulta->with('cidade', 'cidade.pais');

        //$clientes = $consulta->get();
        $clientes = $consulta->paginate(5)->withQueryString();

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

        session()->flash('mensagem', 'Dados inseridos com sucesso');

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

    public function buscarCep(Request $request) {
        $response = Http::get("https://viacep.com.br/ws/{$request->cep}/json");
        if ($response->status() == 200) {
            $dados = $response->json();
            if (isset($dados['erro'])) {
                return response()->json(['erro' => 'CEP não encontrado']);
            } else {
                return $dados;
            }
        } else {
            return response()->json(['erro' => 'CEP inválido']);
        }
        return ['cep' => $request->cep];
    }
}
