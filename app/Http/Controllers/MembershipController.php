<?php

namespace App\Http\Controllers;

use App\Models\Gym;
use App\Models\Login;
use App\Models\Membership;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

/**
 * Class MembershipController
 *
 * Controlador encargado de gestionar las membresías de los usuarios de un gimnasio.
 * Permite listar, crear, editar, actualizar y eliminar membresías,
 * así como filtrar y paginar los registros.
 *
 * @package App\Http\Controllers
 */
class MembershipController extends Controller
{
    /**
     * Obtiene el usuario actualmente logueado en sesión.
     *
     * @return \App\Models\User|abort
     */
    private function getCurrentUser()
    {
        $login = Login::find(Session::get('login_id'));

        if (!$login || !$login->loginable) {
            abort(403, 'Sesión inválida.');
        }

        return $login->loginable;
    }

    /**
     * Obtiene todos los usuarios de un gimnasio.
     *
     * @param int $gymId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    private function getGymUsers(int $gymId)
    {
        return User::where('gym_id', $gymId)->get();
    }

    /**
     * Obtiene los tipos de membresía únicos de un gimnasio.
     *
     * @param int $gymId
     * @return \Illuminate\Support\Collection
     */
    private function getMembershipTypes(int $gymId)
    {
        return Membership::whereHas('user', fn($q) => $q->where('gym_id', $gymId))
                         ->distinct('type')
                         ->pluck('type');
    }

    /**
     * Muestra el listado de membresías con filtros y paginación.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $user = $this->getCurrentUser();
        $gym = $user->gym;
        $perPage = (int) $request->input('per_page', 10);

        $query = Membership::with('user')
            ->whereHas('user', fn($q) => $q->where('gym_id', $gym->id)
                ->when($request->filled('user_name'), fn($q2) => $q2->where('name', 'LIKE', "%{$request->user_name}%"))
            );

        // Filtros dinámicos
        $filters = [
            'id' => fn($q, $value) => $q->where('id', 'like', "%$value%"),
            'user_id' => fn($q, $value) => $q->where('user_id', $value),
            'type' => fn($q, $value) => $value !== 'all' ? $q->where('type', $value) : $q,
            'start_date' => fn($q, $value) => $q->whereDate('start_date', $value),
            'finish_date' => fn($q, $value) => $q->whereDate('finish_date', $value),
        ];

        foreach ($filters as $key => $callback) {
            if ($request->filled($key)) {
                $query = $callback($query, $request->$key);
            }
        }

        // Filtro general de búsqueda
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('amount', 'like', "%$search%")
                  ->orWhere('discount', 'like', "%$search%")
                  ->orWhereHas('user', fn($q2) => $q2->where('name', 'like', "%$search%"));
            });
        }

        $memberships = $query->paginate($perPage)->withQueryString();
        $types = $this->getMembershipTypes($gym->id);
        $users = $this->getGymUsers($gym->id);

        return view('admin.memberships.index', compact('memberships', 'user', 'types', 'users'));
    }

    /**
     * Muestra el formulario para crear una nueva membresía.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $user = $this->getCurrentUser();
        $gym = $user->gym;
        $users = $this->getGymUsers($gym->id);

        return view('admin.memberships.create', compact('user', 'gym', 'users'));
    }

    /**
     * Almacena una nueva membresía en la base de datos.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $user = $this->getCurrentUser();
        $gym = $user->gym;

        $request->validate([
            'type' => 'required|string|max:255|in:Mensual,Diaria,Trimestral,Anual',
            'amount' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0|max:100',
            'start_date' => 'required|date',
            'finish_date' => 'required|date|after_or_equal:start_date',
            'user_id' => [
                'required',
                function ($attr, $value, $fail) use ($gym) {
                    if (!User::where('id', $value)->where('gym_id', $gym->id)->exists()) {
                        $fail('No existe un usuario con esta cédula en el gimnasio.');
                    }
                },
            ],
        ]);

        $userMember = User::where('id', $request->user_id)
                          ->where('gym_id', $gym->id)
                          ->firstOrFail();

        $membership = Membership::create([
            'type' => $request->type,
            'amount' => $request->amount,
            'discount' => $request->discount ?? 0,
            'start_date' => $request->start_date,
            'finish_date' => $request->finish_date,
            'user_id' => $userMember->id,
        ]);

        return redirect()->route('admin.payments.store')->with([
            'user_id' => $userMember->id,
            'membership_id' => $membership->id,
            'amount' => $membership->amount,
            'success' => 'Membresía creada correctamente. Ahora puedes registrar el pago.',
        ]);
    }

    /**
     * Muestra el formulario de edición de una membresía existente.
     *
     * @param Membership $membership
     * @return \Illuminate\View\View
     */
    public function edit(Membership $membership)
    {
        $user = $this->getCurrentUser();
        $gym = $user->gym;
        $users = $this->getGymUsers($gym->id);
        $types = $this->getMembershipTypes($gym->id);

        return view('admin.memberships.edit', compact('membership', 'users', 'gym', 'types'));
    }

    /**
     * Actualiza los datos de una membresía existente.
     *
     * @param Request $request
     * @param Membership $membership
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Membership $membership)
    {
        $user = $this->getCurrentUser();
        $gym = $user->gym;

        $request->validate([
            'type' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0|max:100',
            'start_date' => 'required|date',
            'finish_date' => 'required|date|after_or_equal:start_date',
            'user_id' => ['required', function ($attr, $value, $fail) use ($gym) {
                if (!User::where('id', $value)->where('gym_id', $gym->id)->exists()) {
                    $fail('Usuario no pertenece a este gimnasio.');
                }
            }],
        ]);

        $membership->update($request->only('type', 'amount', 'discount', 'start_date', 'finish_date', 'user_id'));

        return redirect()->route('admin.memberships')->with('success', 'Membresía actualizada correctamente.');
    }

    /**
     * Elimina una membresía del sistema.
     *
     * @param Membership $membership
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Membership $membership)
    {
        $membership->delete();
        return redirect()->route('admin.memberships')->with('success', 'Membresía eliminada correctamente.');
    }
}
