<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReceptionistController extends Controller
{
    public function dashboard(Request $request)
    {
        $receptionist = $request->attributes->get('actor');
        return view('receptionist.dashboard', compact('receptionist'));
    }
}

