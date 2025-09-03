<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class UserController extends Controller
{
    private function getCurrentUser()
    {
        $login = Login::find(Session::get('login_id'));

        if (!$login || !$login->loginable) {
            return redirect('/login')->withErrors(['access' => 'Sesión inválida']);
        }

        return $login->loginable;
    }

    public function index(Request $request)
    {
        $currentUser = $this->getCurrentUser();
        if ($currentUser instanceof \Illuminate\Http\RedirectResponse) return $currentUser;

        $gym = $currentUser->gym;
        $query = $gym->users();

        if ($request->filled('search')) {
            $search = $request->search;
            $convertedDate = preg_match('/^\d{2}\/\d{2}\/\d{4}$/', $search)
                ? Carbon::createFromFormat('d/m/Y', $search)->format('Y-m-d')
                : null;

            $query->where(function ($q) use ($search, $convertedDate) {
                $q->where('name', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%")
                  ->orWhere('phone_number', 'like', "%$search%")
                  ->orWhere('state', 'like', "%$search%")
                  ->orWhere('gender', 'like', "%$search%");
                if ($convertedDate) $q->orWhere('birth_date', $convertedDate);
            });
        }

        if ($request->filled('state') && $request->state !== 'all') {
            $query->where('state', $request->state);
        }

        if ($request->filled('gender') && $request->gender !== 'all') {
            $query->where('gender', $request->gender);
        }

        if ($request->filled('id')) {
            $query->where('id', 'like', "%{$request->id}%");
        }

        $users = $query->paginate($request->input('per_page', 10));

        return view('admin.users.index', compact('users', 'currentUser', 'gym'));
    }

    public function create()
    {
        $currentUser = $this->getCurrentUser();
        if ($currentUser instanceof \Illuminate\Http\RedirectResponse) return $currentUser;

        return view('admin.users.create', [
            'user' => $currentUser,
            'gym'  => $currentUser->gym
        ]);
    }

    public function store(Request $request)
    {
        $currentUser = $this->getCurrentUser();
        if ($currentUser instanceof \Illuminate\Http\RedirectResponse) return $currentUser;

        $request->validate([
            'id'           => 'required|numeric|digits_between:5,20|unique:users,id',
            'name'         => 'required|string|max:255',
            'gender'       => 'required|in:M,F',
            'birth_date'   => 'required|date',
            'phone_number' => 'required|string|max:20',
            'email'        => 'required|email|unique:users,email',
            'state'        => 'required|in:Activo,Inactivo',
        ]);

        User::create([
            'id'           => $request->id,
            'name'         => ucwords(strtolower($request->name)),
            'gender'       => $request->gender,
            'birth_date'   => $request->birth_date,
            'phone_number' => $request->phone_number,
            'email'        => $request->email,
            'state'        => $request->state,
            'gym_id'       => $request->gym_id,
        ]);

        return redirect()->route(class_basename($currentUser) === 'Admin' ? 'admin.users' : 'receptionist.users')
            ->with('success', 'Usuario registrado correctamente.');
    }

    public function edit(User $user)
    {
        $currentUser = $this->getCurrentUser();
        if ($currentUser instanceof \Illuminate\Http\RedirectResponse) return $currentUser;

        return view('admin.users.index', [
            'users'    => $currentUser->gym->users()->paginate(10),
            'user'     => $currentUser,
            'gym'      => $currentUser->gym,
            'editUser' => $user
        ]);
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'         => 'required|string|max:255',
            'gender'       => 'required|in:M,F',
            'birth_date'   => 'required|date',
            'phone_number' => 'required|string|max:20',
            'email'        => 'required|email|unique:users,email,' . $user->id,
            'state'        => 'required|in:Activo,Inactivo',
        ]);

        $user->update([
            'name'         => ucwords(strtolower($request->name)),
            'gender'       => $request->gender,
            'birth_date'   => $request->birth_date,
            'phone_number' => $request->phone_number,
            'email'        => $request->email,
            'state'        => $request->state,
        ]);

        return redirect()->route('admin.users')
            ->with('success', 'Usuario actualizado correctamente.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users')
            ->with('success', 'Usuario eliminado correctamente.');
    }

    public function dashboard()
    {
        $activos   = User::where('state', 'activo')->count();
        $inactivos = User::where('state', 'inactivo')->count();

        $usuariosMesPasado = User::whereBetween('created_at', [
            Carbon::now()->subMonth()->startOfMonth(),
            Carbon::now()->subMonth()->endOfMonth()
        ])->count();

        return view('admin.dashboard', compact('activos', 'inactivos', 'usuariosMesPasado'));
    }

    public function userStats(Request $request)
    {
        $period = $request->query('period', 'all');
        $query = User::query();

        $periods = [
            'today'          => [Carbon::today(), Carbon::today()],
            'this_month'     => [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()],
            'last_month'     => [Carbon::now()->subMonth()->startOfMonth(), Carbon::now()->subMonth()->endOfMonth()],
            'two_months_ago' => [Carbon::now()->subMonths(2)->startOfMonth(), Carbon::now()->subMonths(2)->endOfMonth()],
        ];

        if (isset($periods[$period])) {
            $query->whereBetween('created_at', $periods[$period]);
        }

        return response()->json([
            'activos'   => (clone $query)->where('state', 'activo')->count(),
            'inactivos' => (clone $query)->where('state', 'inactivo')->count()
        ]);
    }

    public function usersByMonth()
    {
        return response()->json(
            User::selectRaw("DATE_FORMAT(created_at, '%Y-%m') as mes, COUNT(*) as total")
                ->groupBy('mes')
                ->orderBy('mes')
                ->get()
        );
    }
}

