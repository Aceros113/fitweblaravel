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
    public function index(Request $request)
    {
        $loginId = Session::get('login_id');
        $login = Login::find($loginId);

        if (!$login || !$login->loginable) {
            return redirect('/login')->withErrors(['access' => 'Sesión inválida']);
        }

        $user = $login->loginable;
        $gym = $user->gym;
        $perPage = $request->input('per_page', 10);

        $query = Payment::whereHas('user', function ($q) use ($gym, $request) {
            $q->where('gym_id', $gym->id);

            if ($request->filled('user_name')) {
                $q->where('name', 'like', '%' . $request->user_name . '%');
            }
        })->with(['user', 'membership']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('amount', 'like', "%$search%")
                    ->orWhereHas('user', function ($q2) use ($search) {
                        $q2->where('name', 'like', "%$search%");
                    });
            });
        }

        // Filtro por id
        if ($request->has('id') && $request->id !== null) {
            $query->where('id', 'like', '%' . $request->id . '%');
        }

        // Filtro por id de usuario
        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        if ($request->filled('payment_method') && $request->payment_method !== 'all') {
            $query->where('payment_method', $request->payment_method);
        }

        if ($request->filled('date')) {
            $query->whereDate('date', $request->date);
        }

        if ($request->filled('membership_id')) {
            $query->where('membership_id', $request->membership_id);
        }

        $payments = $query->paginate($perPage)->withQueryString();

        $memberships = Membership::whereHas('user', function ($q) use ($gym) {
            $q->where('gym_id', $gym->id);
        })->whereHas('payments')->with('user')->get();

        $paymentMethods = Payment::whereHas('user', function ($q) use ($gym) {
            $q->where('gym_id', $gym->id);
        })->select('payment_method')->distinct()->pluck('payment_method');

        $users = User::where('gym_id', $gym->id)->get();



        return view('admin.payments.index', compact('payments', 'users', 'memberships', 'paymentMethods'));
    }

    public function store(Request $request)
    {
        $login = Login::find(Session::get('login_id'));
        $user = $login->loginable;
        $gym = $user->gym;

        $request->validate([
            'date' => 'required|date',
            'amount' => 'required|numeric|min:0',
            'payment_method' => 'required|string|max:255',
            'user_id' => [
                'required',
                function ($attribute, $value, $fail) use ($gym) {
                    $user = User::where('id', $value)
                        ->where('gym_id', $gym->id)
                        ->first();

                    if (!$user) {
                        $fail('No existe un usuario con esta cédula en el gimnasio.');
                    }
                }
            ],
            'membership_id' => [
                'required',
                function ($attribute, $value, $fail) use ($gym) {
                    $membership = Membership::where('id', $value)
                        ->whereHas('user', function ($q) use ($gym) {
                            $q->where('gym_id', $gym->id);
                        })
                        ->first();

                    if (!$membership) {
                        $fail('La membresía no corresponde a un usuario del gimnasio.');
                    }
                }
            ],
        ]);

        Payment::create([
            'date' => $request->date,
            'amount' => $request->amount,
            'payment_method' => $request->payment_method,
            'user_id' => $request->user_id,
            'membership_id' => $request->membership_id,
        ]);

        return redirect()->route(class_basename($user) === 'Admin' ? 'admin.payments' : 'receptionist.payments')
            ->with('success', 'Pago registrado correctamente.');
    }

    public function edit(Payment $payment)
    {
        $login = Login::find(Session::get('login_id'));
        $user = $login->loginable;
        $gym = $user->gym;

        // Asegurarse de que el pago pertenece a un usuario del gimnasio
        if ($payment->user->gym_id !== $gym->id) {
            abort(403, 'No autorizado.');
        }

        $users = User::where('gym_id', $gym->id)->get();

        $memberships = Membership::whereHas('user', function ($q) use ($gym) {
            $q->where('gym_id', $gym->id);
        })->get();

        $paymentMethods = Payment::whereHas('user', function ($q) use ($gym) {
            $q->where('gym_id', $gym->id);
        })->select('payment_method')->distinct()->pluck('payment_method');

        return view('admin.payments.edit', compact('payment', 'users', 'memberships', 'paymentMethods'));
    }


    public function update(Request $request, Payment $payment)
    {


        $login = Login::find(Session::get('login_id'));
        $user = $login->loginable;
        $gym = $user->gym;
    
        // Verificar que el pago esté en el gimnasio correcto
        if ($payment->user->gym_id !== $gym->id) {
            abort(403, 'No autorizado.');
        }
    
        $request->validate([
            'date' => 'required|date',
            'amount' => 'required|numeric|min:0',
            'payment_method' => 'required|string|max:255',
            'user_id' => [
                'required',
                function ($attribute, $value, $fail) use ($gym) {
                    if (!User::where('id', $value)->where('gym_id', $gym->id)->exists()) {
                        $fail('El usuario no pertenece a este gimnasio.');
                    }
                }
            ],

        ]);
    
        $payment->update([
            'date' => $request->date,
            'amount' => $request->amount,
            'payment_method' => $request->payment_method,
            'user_id' => $request->user_id,
        ]);
    
        return redirect()->route('admin.payments')->with('success', 'Pago actualizada correctamente.');

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

        // Datos para la gráfica mensual
        $gananciasPorMes = Payment::selectRaw('MONTH(created_at) as mes, SUM(amount) as total')
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy('mes')
            ->orderBy('mes')
            ->get();

        $meses = [];
        $totales = [];

        for ($i = 1; $i <= 12; $i++) {
            $meses[] = ucfirst(Carbon::create()->month($i)->locale('es')->monthName); // ej: Enero, Febrero
            $total = $gananciasPorMes->firstWhere('mes', $i)?->total ?? 0;
            $totales[] = $total;
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
