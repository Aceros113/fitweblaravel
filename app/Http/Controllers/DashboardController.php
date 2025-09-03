<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Usuarios activos/inactivos
        $activos = User::where('estado', 'activo')->count();
        $inactivos = User::where('estado', 'inactivo')->count();

        // 2. Ganancias mensuales (últimos 6 meses)
        $pagosPorMes = Payment::selectRaw('MONTHNAME(created_at) as mes, SUM(monto) as total')
            ->where('created_at', '>=', now()->subMonths(6))
            ->groupBy(DB::raw('MONTH(created_at)'), DB::raw('MONTHNAME(created_at)'))
            ->orderBy(DB::raw('MONTH(created_at)'))
            ->get();

        $meses = $pagosPorMes->pluck('mes');
        $totales = $pagosPorMes->pluck('total');

        return view('admin.dashboard', compact('activos', 'inactivos', 'meses', 'totales'));
    }
}

