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
            'email' => 'required|email|max:255',
            'password' => 'required|min:6|max:255',
        ], [
            'email.required' => 'El correo es obligatorio.',
            'email.email' => 'Ingrese un correo válido.',
            'email.max' => 'El correo no puede exceder 255 caracteres.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 6 caracteres.',
            'password.max' => 'La contraseña no puede exceder 255 caracteres.',
        ]);

        $login = Login::where('email', $request->email)->first();

        if (!$login) {
            return back()->withErrors(['email' => 'El correo no está registrado'])->withInput();
        }

        if (!Hash::check($request->password, $login->password)) {
            return back()->withErrors(['password' => 'Contraseña incorrecta'])->withInput();
        }

        $user = $login->loginable;
        if (!$user) {
            return back()->withErrors(['email' => 'Tipo de usuario no reconocido'])->withInput();
        }

        Session::put('login_id', $login->id);
        $userType = class_basename($user);
        Session::put('user_type', $userType);

        try {
            return match ($userType) {
                'Admin' => redirect()->route('admin.dashboard'),
                'Receptionist' => redirect()->route('receptionist.dashboard'),
                default => throw new \Exception('Tipo de usuario no soportado'),
            };
        } catch (\Exception $e) {
            Session::flush(); 
            return back()->withErrors(['email' => $e->getMessage()])->withInput();
        }
    }

    // Cerrar sesión
    public function logout(Request $request)
    {
        Session::flush(); 
        return redirect()->route('login')->with('message', 'Sesión cerrada correctamente');
    }
}
