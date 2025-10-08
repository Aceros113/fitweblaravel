<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Login;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class EnsureUserHasRole
 *
 * Middleware que asegura que el usuario autenticado
 * tenga el rol indicado antes de permitir el acceso a la ruta.
 *
 * Se utiliza para roles como 'Admin', 'Receptionist', etc.
 *
 * @package App\Http\Middleware
 */
class EnsureUserHasRole
{
    /**
     * Maneja la solicitud entrante.
     *
     * @param Request $request
     * @param Closure $next
     * @param string $role Rol requerido para acceder a la ruta.
     * @return Response
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        $loginId = Session::get('login_id');

        // Validar existencia de sesión
        if (!$loginId) {
            return redirect()->route('login')->withErrors(['access' => 'Debe iniciar sesión.']);
        }

        $login = Login::find($loginId);

        // Validar existencia de login y relación loginable
        if (!$login || !$login->loginable) {
            Session::flush();
            return redirect()->route('login')->withErrors(['access' => 'Sesión inválida.']);
        }

        // Validar rol del usuario
        $userRole = strtolower(class_basename($login->loginable));
        if ($userRole !== strtolower($role)) {
            return redirect()->route('login')->withErrors(['access' => 'No tiene permisos para acceder a esta sección.']);
        }

        // Asignar actor a la request para uso en controladores
        $request->attributes->set('actor', $login->loginable);

        return $next($request);
    }
}
