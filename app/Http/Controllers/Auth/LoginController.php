<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Login;
use Illuminate\Validation\ValidationException;

/**
 * Class LoginController
 *
 * Controlador encargado de gestionar la autenticación de usuarios
 * incluyendo login y logout, con manejo de sesiones y validaciones.
 *
 * @package App\Http\Controllers\Auth
 */
class LoginController extends Controller
{
    /**
     * Muestra el formulario de inicio de sesión.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Procesa la solicitud de inicio de sesión.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        // Validaciones de entrada
        $this->validateLogin($request);

        // Buscar usuario por correo
        $login = Login::where('email', $request->email)->first();

        if (!$login) {
            return $this->sendFailedLoginResponse('El correo no está registrado.');
        }

        // Verificar contraseña
        if (!Hash::check($request->password, $login->password)) {
            return $this->sendFailedLoginResponse('Contraseña incorrecta.');
        }

        // Verificar tipo de usuario
        $user = $login->loginable;
        if (!$user) {
            return $this->sendFailedLoginResponse('Tipo de usuario no reconocido.');
        }

        // Guardar datos en sesión
        Session::put('login_id', $login->id);
        $userType = class_basename($user);
        Session::put('user_type', $userType);

        // Redirigir según tipo de usuario
        try {
            return match ($userType) {
                'Admin' => redirect()->route('admin.dashboard'),
                'Receptionist' => redirect()->route('receptionist.dashboard'),
                default => throw new \Exception('Tipo de usuario no soportado.'),
            };
        } catch (\Exception $e) {
            Session::flush();
            return $this->sendFailedLoginResponse($e->getMessage());
        }
    }

    /**
     * Cierra la sesión del usuario.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Session::flush();
        return redirect()->route('login')->with('message', 'Sesión cerrada correctamente.');
    }

    /**
     * Valida los datos de inicio de sesión.
     *
     * @param Request $request
     * @return void
     */
    protected function validateLogin(Request $request): void
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
    }

    /**
     * Retorna una respuesta de error al fallar el inicio de sesión.
     *
     * @param string $message
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function sendFailedLoginResponse(string $message)
    {
        return back()->withErrors(['login' => $message])->withInput();
    }
}
