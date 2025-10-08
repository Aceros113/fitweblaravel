<?php

namespace App\Http\Controllers;

use App\Models\AttendanceUser;
use App\Models\Login;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

/**
 * Class AttendanceUserController
 *
 * Controlador encargado de gestionar las asistencias de los usuarios de un gimnasio.
 * Incluye CRUD completo, validaciones y control de permisos según el gimnasio del usuario autenticado.
 *
 * @package App\Http\Controllers
 */
class AttendanceUserController extends Controller
{
    /**
     * Obtiene el usuario autenticado en sesión.
     *
     * @return \App\Models\User|null
     */
    private function getAuthenticatedUser(): ?User
    {
        $login = Login::find(Session::get('login_id'));

        if (!$login || !$login->loginable || !$login->loginable->gym) {
            return null;
        }

        return $login->loginable;
    }

    /**
     * Obtiene todos los usuarios de un gimnasio específico.
     *
     * @param int $gymId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    private function getGymUsers(int $gymId)
    {
        return User::where('gym_id', $gymId)->get();
    }

    /**
     * Valida la entrada para el registro o actualización de asistencia.
     *
     * @param Request $request
     * @param $gym
     * @return array
     */
    private function validateAttendance(Request $request, $gym): array
    {
        return $request->validate([
            'check_in' => 'required|date_format:H:i',
            'check_out' => 'nullable|date_format:H:i|after_or_equal:check_in',
            'date' => 'required|date',
            'user_id' => [
                'required',
                function ($attribute, $value, $fail) use ($gym) {
                    $user = User::where('id', $value)
                        ->where('gym_id', $gym->id)
                        ->first();

                    if (!$user) {
                        $fail('No existe un usuario con este ID en el gimnasio.');
                    }
                },
            ],
        ]);
    }

    /**
     * Verifica que la asistencia pertenezca al gimnasio del usuario.
     *
     * @param AttendanceUser $attendance
     * @param int $gymId
     * @return void
     */
    private function authorizeAttendance(AttendanceUser $attendance, int $gymId): void
    {
        if ($attendance->user->gym_id !== $gymId) {
            abort(403, 'No autorizado');
        }
    }

    /**
     * Lista las asistencias filtradas y paginadas por gimnasio.
     *
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function index(Request $request)
    {
        $user = $this->getAuthenticatedUser();
        if (!$user) {
            return redirect('/login')->withErrors(['access' => 'Sesión inválida']);
        }

        $gym = $user->gym;
        $perPage = $request->input('per_page', 10);

        $query = AttendanceUser::whereHas('user', function ($q) use ($gym, $request) {
            $q->where('gym_id', $gym->id);

            if ($request->filled('user_name')) {
                $q->where('name', 'like', '%' . $request->user_name . '%');
            }
        })->with('user');

        if ($request->filled('date')) {
            $query->whereDate('date', $request->date);
        }

        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        $attendances = $query->paginate($perPage)->withQueryString();
        $users = $this->getGymUsers($gym->id);

        return view('admin.attendance-users.index', compact('attendances', 'user', 'users'));
    }

    /**
     * Muestra el formulario de creación de asistencia.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function create()
    {
        $user = $this->getAuthenticatedUser();
        if (!$user) {
            return redirect('/login')->withErrors(['access' => 'Sesión inválida']);
        }

        $users = $this->getGymUsers($user->gym->id);
        return view('admin.attendance-users.create', compact('user', 'users'));
    }

    /**
     * Registra una nueva asistencia.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $user = $this->getAuthenticatedUser();
        if (!$user) {
            return redirect('/login')->withErrors(['access' => 'Sesión inválida']);
        }

        $validated = $this->validateAttendance($request, $user->gym);

        AttendanceUser::create($validated);

        return redirect()->route('admin.attendance-users')
                         ->with('success', 'Asistencia registrada exitosamente.');
    }

    /**
     * Muestra el formulario de edición de una asistencia.
     *
     * @param AttendanceUser $attendance
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function edit(AttendanceUser $attendance)
    {
        $user = $this->getAuthenticatedUser();
        if (!$user) {
            return redirect('/login')->withErrors(['access' => 'Sesión inválida']);
        }

        $this->authorizeAttendance($attendance, $user->gym->id);
        $users = $this->getGymUsers($user->gym->id);

        return view('admin.attendance-users.edit', compact('attendance', 'users', 'user'));
    }

    /**
     * Actualiza la información de la asistencia.
     *
     * @param Request $request
     * @param AttendanceUser $attendance
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, AttendanceUser $attendance)
    {
        $user = $this->getAuthenticatedUser();
        if (!$user) {
            return redirect('/login')->withErrors(['access' => 'Sesión inválida']);
        }

        $attendance->load('user');
        $this->authorizeAttendance($attendance, $user->gym->id);

        $validated = $request->validate([
            'check_out' => 'required|date_format:H:i|after_or_equal:check_in',
        ]);

        $attendance->update([
            'check_out' => $validated['check_out'],
        ]);

        return redirect()->route('admin.attendance-users')
                         ->with('success', 'Asistencia finalizada correctamente.');
    }

    /**
     * Elimina una asistencia registrada.
     *
     * @param AttendanceUser $attendance
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(AttendanceUser $attendance)
    {
        $attendance->delete();

        return redirect()->route('admin.attendance-users')
                        ->with('success', 'Asistencia eliminada correctamente.');
    }
}
