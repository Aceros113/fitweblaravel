<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;

/**
 * Class DashboardController
 *
 * Controlador encargado de gestionar los datos y estadísticas del panel de administración.
 *
 * @package App\Http\Controllers
 */
class DashboardController extends Controller
{
    /**
     * Muestra el dashboard con estadísticas de usuarios y pagos.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // 1. Contar usuarios activos e inactivos
        $activos = $this->countUsersByStatus('activo');
        $inactivos = $this->countUsersByStatus('inactivo');

        // 2. Obtener ganancias mensuales de los últimos 6 meses
        [$meses, $totales] = $this->getMonthlyPayments(6);

        return view('admin.dashboard', compact('activos', 'inactivos', 'meses', 'totales'));
    }

    /**
     * Cuenta usuarios según su estado.
     *
     * @param string $status
     * @return int
     */
    private function countUsersByStatus(string $status): int
    {
        return User::where('estado', $status)->count();
    }

    /**
     * Obtiene los pagos mensuales de los últimos X meses.
     *
     * @param int $months
     * @return array [meses, totales]
     */
    private function getMonthlyPayments(int $months = 6): array
    {
        $pagosPorMes = Payment::selectRaw('MONTHNAME(created_at) as mes, SUM(monto) as total')
            ->where('created_at', '>=', now()->subMonths($months))
            ->groupBy(DB::raw('MONTH(created_at)'), DB::raw('MONTHNAME(created_at)'))
            ->orderBy(DB::raw('MONTH(created_at)'))
            ->get();

        $meses = $pagosPorMes->pluck('mes');
        $totales = $pagosPorMes->pluck('total');

        return [$meses, $totales];
    }
}
