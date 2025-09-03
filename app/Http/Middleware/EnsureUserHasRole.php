<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Login;
use Illuminate\Support\Facades\Session;

class EnsureUserHasRole
{
    public function handle(Request $request, Closure $next, string $role)
    {
        $login = Login::find(Session::get('login_id'));

        if (!$login || strtolower(class_basename($login->loginable)) !== strtolower($role)) {
            return redirect('/login');
        }

        $request->attributes->set('actor', $login->loginable);

        return $next($request);
    }
}
