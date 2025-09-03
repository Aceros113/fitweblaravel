<?php

namespace App\Http\Controllers;

use App\Models\Login;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;

class ReceptionistController extends Controller
{
    public function dashboard()
    {
        $login = Login::find(Session::get('login_id'));

        if (!$login || class_basename($login->loginable) !== 'Receptionist') {
            return redirect('/login')->withErrors(['access' => 'Acceso no autorizado']);
        }

        $receptionist = $login->loginable;

        return view('receptionist.dashboard', compact('receptionist'));
    }
}
