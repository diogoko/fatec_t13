<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CidadesController extends Controller
{
    public function listar(Request $request) {
        $consulta = DB::table('cidades');

        $filtroNome = $request->nome;
        if ($filtroNome) {
            $consulta->where('nome', 'like', "%$filtroNome%");
        }
        $consulta->orderBy('nome');

        $cidades = $consulta->get();

        return view('cidades.lista', [
            'cidades' => $cidades,
            'nome' => $filtroNome,
        ]);
    }

    private function validar($request) {
        $request->validate([
            'nome' => 'required|max:200',
            'estado' => 'required|size:2',
        ]);
    }

    public function inserir(Request $request) {
        $this->validar($request);
        $nome = $request->nome;
        $estado = $request->estado;

        DB::table('cidades')->insertGetId([
            'nome' => $nome,
            'estado' => $estado,
        ]);

        return redirect()->route('CidadesListar');
    }

    public function editar($id) {
        $cidade = DB::table('cidades')->find($id);

        return view('cidades.formulario', [
            'id' => $cidade->id,
            'nome' => $cidade->nome,
            'estado' => $cidade->estado,
            'editando' => true,
        ]);
    }

    public function alterar(Request $request, $id) {
        $this->validar($request);
        $nome = $request->nome;
        $estado = $request->estado;

        DB::table('cidades')->where('id', $id)->update(compact('nome', 'estado'));

        return redirect()->route('CidadesListar');
    }
}
