<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Class ReceptionistController
 *
 * Controlador encargado de gestionar las vistas y acciones del recepcionista.
 *
 * @package App\Http\Controllers
 */
class ReceptionistController extends Controller
{
    /**
     * Muestra el dashboard del recepcionista.
     *
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function dashboard(Request $request)
    {
        // Obtener el recepcionista desde los atributos de la request
        $receptionist = $request->attributes->get('actor');

        // Validar que exista un actor válido
        if (!$receptionist) {
            return redirect()->route('login')->withErrors(['access' => 'Sesión inválida.']);
        }

        return view('receptionist.dashboard', compact('receptionist'));
    }
}
