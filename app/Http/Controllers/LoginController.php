<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function formulario(Request $request) {
        $u = User::find(2);
        Auth::login($u);
        return view('login');
    }

    public function verificar(Request $request) {
        $dadosValidados = $request->validate([
            'email' => 'required',
            'senha' => 'required',
        ]);

        /*
        $usuario = User::where('email', $request->email)->first();
        if ($usuario != null && Hash::check($request->senha, $usuario->password)) {
            session()->regenerate();
            Auth::login($usuario);

            session()->flash('mensagem', 'Usuário logado com sucesso');

            return redirect()->route('ClientesListar');
        } else {
            return back()->withErrors(['email' => 'Usuário ou senha incorretos']);
        }
        */

        if (Auth::attempt(['email' => $request->email, 'password' => $request->senha])) {
            session()->regenerate();

            session()->flash('mensagem', 'Usuário logado com sucesso');

            return redirect()->route('ClientesListar');
        } else {
            return back()->withErrors(['email' => 'Usuário ou senha incorretos']);
        }
    }

    public function logout(Request $request) {
        Auth::logout();

        // somente no logout
        session()->invalidate();


        session()->regenerate();

        session()->flash('mensagem', 'Usuário deslogado com sucesso');

        return redirect()->route('ClientesListar');
    }

}
