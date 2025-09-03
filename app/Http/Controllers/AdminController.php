<?php

namespace App\Http\Controllers;

use App\Models\Login;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $login = Login::find(Session::get('login_id'));

        if (!$login || class_basename($login->loginable) !== 'Admin') {
            return redirect('/login')->withErrors(['access' => 'Acceso no autorizado']);
        }

        $admin = $login->loginable;

        return view('admin.dashboard', compact('admin'));
    }
}
