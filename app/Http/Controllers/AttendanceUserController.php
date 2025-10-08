<?php

namespace App\Http\Controllers;

use App\Models\AttendanceUser;
use App\Models\Login;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AttendanceUserController extends Controller
{

    private function getAuthenticatedUser()
    {
        $login = Login::find(Session::get('login_id'));

        if (!$login || !$login->loginable || !$login->loginable->gym) {
            return null;
        }

        return $login->loginable;
    }

    private function getGymUsers($gymId)
    {
        return User::where('gym_id', $gymId)->get();
    }

    private function validateAttendance(Request $request, $gym)
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

    private function authorizeAttendance(AttendanceUser $attendance, $gymId)
    {
        if ($attendance->user->gym_id !== $gymId) {
            abort(403, 'No autorizado');
        }
    }

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

    public function create()
    {
        $user = $this->getAuthenticatedUser();
        if (!$user) {
            return redirect('/login')->withErrors(['access' => 'Sesión inválida']);
        }

        $users = $this->getGymUsers($user->gym->id);
        return view('admin.attendance-users.create', compact('user', 'users'));
    }

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

    public function destroy(AttendanceUser $attendance)
    {
        $attendance->delete();

        return redirect()->route('admin.attendance-users')
                        ->with('success', 'Asistencia eliminada correctamente.');
    }
}
