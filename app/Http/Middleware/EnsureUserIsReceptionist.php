<?php

namespace App\Http\Middleware;

use App\Models\Login;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class EnsureUserIsReceptionist
{
    public function handle(Request $request, Closure $next)
    {
        $loginId = Session::get('login_id');
        $userType = Session::get('user_type');
    
        if (!$loginId || $userType !== 'Receptionist') {
            return redirect('/login')->withErrors(['access' => 'Acceso no autorizado']);
        }
    
        // (Opcional) Si quieres asegurarte de que el login existe
        $login = Login::find($loginId);
        if (!$login) {
            Session::flush();
            return redirect('/login')->withErrors(['access' => 'Sesión inválida']);
        }
    
        return $next($request);
    }
}