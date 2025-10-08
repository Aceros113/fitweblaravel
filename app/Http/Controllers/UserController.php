<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

/**
 * Class UserController
 *
 * Controlador encargado de gestionar los usuarios del gimnasio,
 * incluyendo CRUD, dashboard de usuarios y estadísticas.
 *
 * @package App\Http\Controllers
 */
class UserController extends Controller
{
    /**
     * Obtiene el usuario actualmente autenticado.
     *
     * @return \App\Models\User|\Illuminate\Http\RedirectResponse
     */
    private function getCurrentUser()
    {
        $login = Login::find(Session::get('login_id'));

        if (!$login || !$login->loginable) {
            return redirect()->route('login')->withErrors(['access' => 'Sesión inválida.']);
        }

        return $login->loginable;
    }

    /**
     * Muestra la lista de usuarios con filtros y paginación.
     *
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
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

        $filters = ['state', 'gender', 'id'];
        foreach ($filters as $filter) {
            if ($request->filled($filter) && $request->$filter !== 'all') {
                $query->when($filter === 'state', fn($q) => $q->where('state', $request->$filter))
                      ->when($filter === 'gender', fn($q) => $q->where('gender', $request->$filter))
                      ->when($filter === 'id', fn($q) => $q->where('id', 'like', "%{$request->$filter}%"));
            }
        }

        $users = $query->paginate($request->input('per_page', 10));

        return view('admin.users.index', compact('users', 'currentUser', 'gym'));
    }

    /**
     * Muestra el formulario para crear un nuevo usuario.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function create()
    {
        $currentUser = $this->getCurrentUser();
        if ($currentUser instanceof \Illuminate\Http\RedirectResponse) return $currentUser;

        return view('admin.users.create', [
            'user' => $currentUser,
            'gym'  => $currentUser->gym
        ]);
    }

    /**
     * Almacena un nuevo usuario en la base de datos.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $currentUser = $this->getCurrentUser();
        if ($currentUser instanceof \Illuminate\Http\RedirectResponse) return $currentUser;

        $validated = $request->validate([
            'id'           => 'required|numeric|digits_between:5,20|unique:users,id',
            'name'         => 'required|string|max:255',
            'gender'       => 'required|in:M,F',
            'birth_date'   => 'required|date',
            'phone_number' => 'required|string|max:20',
            'email'        => 'required|email|unique:users,email',
            'state'        => 'required|in:Activo,Inactivo',
        ]);

        $validated['name'] = ucwords(strtolower($validated['name']));
        $validated['gym_id'] = $request->gym_id;

        User::create($validated);

        $route = class_basename($currentUser) === 'Admin' ? 'admin.users' : 'receptionist.users';

        return redirect()->route($route)->with('success', 'Usuario registrado correctamente.');
    }

    /**
     * Muestra el formulario para editar un usuario existente.
     *
     * @param User $user
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function edit(User $user)
    {
        $currentUser = $this->getCurrentUser();
        if ($currentUser instanceof \Illuminate\Http\RedirectResponse) return $currentUser;

        $users = $currentUser->gym->users()->paginate(10);

        return view('admin.users.index', [
            'users'    => $users,
            'user'     => $currentUser,
            'gym'      => $currentUser->gym,
            'editUser' => $user
        ]);
    }

    /**
     * Actualiza un usuario existente.
     *
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name'         => 'required|string|max:255',
            'gender'       => 'required|in:M,F',
            'birth_date'   => 'required|date',
            'phone_number' => 'required|string|max:20',
            'email'        => 'required|email|unique:users,email,' . $user->id,
            'state'        => 'required|in:Activo,Inactivo',
        ]);

        $validated['name'] = ucwords(strtolower($validated['name']));

        $user->update($validated);

        return redirect()->route('admin.users')->with('success', 'Usuario actualizado correctamente.');
    }

    /**
     * Elimina un usuario.
     *
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users')->with('success', 'Usuario eliminado correctamente.');
    }

    /**
     * Dashboard general de usuarios con estadísticas básicas.
     *
     * @return \Illuminate\View\View
     */
    public function dashboard()
    {
        $activos   = User::where('state', 'Activo')->count();
        $inactivos = User::where('state', 'Inactivo')->count();

        $usuariosMesPasado = User::whereBetween('created_at', [
            Carbon::now()->subMonth()->startOfMonth(),
            Carbon::now()->subMonth()->endOfMonth()
        ])->count();

        return view('admin.dashboard', compact('activos', 'inactivos', 'usuariosMesPasado'));
    }

    /**
     * Devuelve estadísticas de usuarios por periodo en formato JSON.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
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
            'activos'   => (clone $query)->where('state', 'Activo')->count(),
            'inactivos' => (clone $query)->where('state', 'Inactivo')->count()
        ]);
    }

    /**
     * Devuelve el número de usuarios registrados por mes.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function usersByMonth()
    {
        $data = User::selectRaw("DATE_FORMAT(created_at, '%Y-%m') as mes, COUNT(*) as total")
                    ->groupBy('mes')
                    ->orderBy('mes')
                    ->get();

        return response()->json($data);
    }
}
