<?php

namespace App\Http\Controllers;

use App\Models\Login;
use App\Models\User;
use App\Models\Payment;
use App\Models\Membership;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class PaymentController extends Controller
{
    private function getCurrentUser()
    {
        $login = Login::find(Session::get('login_id'));

        if (!$login || !$login->loginable) {
            abort(403, 'Sesión inválida.');
        }

        return $login->loginable;
    }

    private function authorizePaymentGym(Payment $payment, $gymId)
    {
        if ($payment->user->gym_id !== $gymId) {
            abort(403, 'No autorizado.');
        }
    }

    public function index(Request $request)
    {
        $user = $this->getCurrentUser();
        $gym = $user->gym;
        $perPage = $request->input('per_page', 10);

        $query = Payment::with(['user', 'membership'])
            ->whereHas('user', function ($q) use ($gym, $request) {
                $q->where('gym_id', $gym->id);

                if ($request->filled('user_name')) {
                    $q->where('name', 'like', '%' . $request->user_name . '%');
                }
            });

        $filters = ['id', 'user_id', 'payment_method', 'date', 'membership_id'];
        foreach ($filters as $filter) {
            if ($request->filled($filter) && $request->$filter !== 'all') {
                $query->when($filter === 'id', fn($q) => $q->where('id', 'like', "%{$request->$filter}%"))
                      ->when($filter === 'user_id', fn($q) => $q->where('user_id', $request->$filter))
                      ->when($filter === 'payment_method', fn($q) => $q->where('payment_method', $request->$filter))
                      ->when($filter === 'date', fn($q) => $q->whereDate('date', $request->$filter))
                      ->when($filter === 'membership_id', fn($q) => $q->where('membership_id', $request->$filter));
            }
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('amount', 'like', "%$search%")
                  ->orWhereHas('user', fn($q2) => $q2->where('name', 'like', "%$search%"));
            });
        }

        $payments = $query->paginate($perPage)->withQueryString();

        $memberships = Membership::whereHas('user', fn($q) => $q->where('gym_id', $gym->id))
            ->whereHas('payments')->with('user')->get();

        $paymentMethods = Payment::whereHas('user', fn($q) => $q->where('gym_id', $gym->id))
            ->distinct()->pluck('payment_method');

        $users = User::where('gym_id', $gym->id)->get();

        return view('admin.payments.index', compact('payments', 'users', 'memberships', 'paymentMethods'));
    }

    public function store(Request $request)
    {
        $user = $this->getCurrentUser();
        $gym = $user->gym;

        $request->validate([
            'date' => 'required|date',
            'amount' => 'required|numeric|min:0',
            'payment_method' => 'required|string|max:255',
            'user_id' => ['required', function ($attr, $value, $fail) use ($gym) {
                if (!User::where('id', $value)->where('gym_id', $gym->id)->exists()) {
                    $fail('Usuario no encontrado en el gimnasio.');
                }
            }],
            'membership_id' => ['required', function ($attr, $value, $fail) use ($gym) {
                if (!Membership::where('id', $value)->whereHas('user', fn($q) => $q->where('gym_id', $gym->id))->exists()) {
                    $fail('Membresía inválida para este gimnasio.');
                }
            }],
        ]);

        Payment::create($request->only('date', 'amount', 'payment_method', 'user_id', 'membership_id'));

        $route = class_basename($user) === 'Admin' ? 'admin.payments' : 'receptionist.payments';

        return redirect()->route($route)->with('success', 'Pago registrado correctamente.');
    }

    {
        $user = $this->getCurrentUser();
        $gym = $user->gym;
        $this->authorizePaymentGym($payment, $gym->id);

        $users = User::where('gym_id', $gym->id)->get();
        $memberships = Membership::whereHas('user', fn($q) => $q->where('gym_id', $gym->id))->get();
        $paymentMethods = Payment::whereHas('user', fn($q) => $q->where('gym_id', $gym->id))
            ->distinct()->pluck('payment_method');

        return view('admin.payments.edit', compact('payment', 'users', 'memberships', 'paymentMethods'));
    }


    public function update(Request $request, Payment $payment)
    {
        $user = $this->getCurrentUser();
        $gym = $user->gym;
        $this->authorizePaymentGym($payment, $gym->id);

        $request->validate([
            'date' => 'required|date',
            'amount' => 'required|numeric|min:0',
            'payment_method' => 'required|string|max:255',
            'user_id' => ['required', function ($attr, $value, $fail) use ($gym) {
                if (!User::where('id', $value)->where('gym_id', $gym->id)->exists()) {
                    $fail('Usuario no pertenece a este gimnasio.');
                }
            }],
        ]);

        $payment->update($request->only('date', 'amount', 'payment_method', 'user_id'));

        return redirect()->route('admin.payments')->with('success', 'Pago actualizado correctamente.');
    }

    public function destroy(Payment $payment)
    {
        $payment->delete();
        return redirect()->route('admin.payments')->with('success', 'Pago eliminado correctamente.');
    }


    public function dashboard()
    {
        $hoy = Carbon::today();
        $inicioMes = Carbon::now()->startOfMonth();
        $inicioAnio = Carbon::now()->startOfYear();

        $gananciasHoy = Payment::whereDate('created_at', $hoy)->sum('amount');
        $gananciasMes = Payment::whereBetween('created_at', [$inicioMes, Carbon::now()])->sum('amount');
        $gananciasAnio = Payment::whereBetween('created_at', [$inicioAnio, Carbon::now()])->sum('amount');

        $gananciasPorMes = Payment::selectRaw('MONTH(created_at) as mes, SUM(amount) as total')
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy('mes')
            ->orderBy('mes')
            ->get();

        $meses = [];
        $totales = [];
        for ($i = 1; $i <= 12; $i++) {
            $meses[] = ucfirst(Carbon::create()->month($i)->locale('es')->monthName);
            $totales[] = $gananciasPorMes->firstWhere('mes', $i)?->total ?? 0;
        }

        return view('admin.dashboard', compact(
            'gananciasHoy',
            'gananciasMes',
            'gananciasAnio',
            'meses',
            'totales'
        ));
    }
}
