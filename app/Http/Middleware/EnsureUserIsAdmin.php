<?php

namespace App\Http\Middleware;

use App\Models\Login;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;

class EnsureUserIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $loginId = Session::get('login_id');
        $userType = Session::get('user_type');
    
        if (!$loginId || $userType !== 'Admin') {
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
