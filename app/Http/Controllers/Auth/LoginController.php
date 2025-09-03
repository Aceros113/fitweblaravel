<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Login;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $login = Login::where('email', $request->email)->first();

        if (!$login || !Hash::check($request->password, $login->password)) {
            return back()->withErrors(['email' => 'Credenciales incorrectas']);
        }

        // Guardar datos en la sesión
        Session::put('login_id', $login->id);

        // Obtener modelo relacionado
        $user = $login->loginable;
        $userType = class_basename($user);
        Session::put('user_type', $userType); // ← Esta línea permite usar los middlewares correctamente

        // Redirigir
        return match ($userType) {
            'Admin' => redirect()->route('admin.dashboard'),
            'Receptionist' => redirect()->route('receptionist.dashboard'),
            default => back()->withErrors(['email' => 'Tipo de usuario no reconocido']),
        };
    }

    public function logout(Request $request)
    {
        Session::flush(); // Limpia todos los datos de sesión
        return redirect('/login')->with('message', 'Sesión cerrada correctamente');
    }
}
