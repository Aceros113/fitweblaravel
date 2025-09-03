<?php

namespace App\Http\Controllers;

use App\Models\AttendanceUser;
use App\Models\Login;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AttendanceUserController extends Controller
{
    public function index(Request $request)
    {
        $login = Login::find(Session::get('login_id'));

        if (!$login || !$login->loginable) {
            return redirect('/login')->withErrors(['access' => 'Sesión inválida']);
        }

        $user = $login->loginable;
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

        $users = User::where('gym_id', $gym->id)->get();

        return view('admin.attendance-users.index', compact('attendances', 'user', 'users'));
    }

    public function create()
    {
        $login = Login::find(Session::get('login_id'));
        $user = $login?->loginable;

        if (!$user || !$user->gym) {
            return redirect('/login')->withErrors(['access' => 'Sesión inválida']);
        }

        $users = User::where('gym_id', $user->gym->id)->get();

        return view('admin.attendance-users.create', compact('user', 'users'));
    }

    public function store(Request $request)
    {
        $login = Login::find(Session::get('login_id'));
        $user = $login?->loginable;
        $gym = $user->gym;

        if (!$user || !$gym) {
            return redirect('/login')->withErrors(['access' => 'Sesión inválida']);
        }

        $request->validate([
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
                }
            ],
        ]);


        AttendanceUser::create([
            'user_id' => $request->user_id,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'date' => $request->date,

        ]);

        return redirect()->route('admin.attendance-users')
                         ->with('success', 'Asistencia registrada exitosamente.');
    }


    public function edit(AttendanceUser $attendance)
    {
        $login = Login::find(Session::get('login_id'));
        $user = $login?->loginable;
        $gym = $user->gym;

        if (!$user || !$gym) {
            return redirect('/login')->withErrors(['access' => 'Sesión inválida']);
        }

        if ($attendance->user->gym_id !== $gym->id) {
            abort(403, 'No autorizado');
        }

        $users = User::where('gym_id', $gym->id)->get();

        return view('admin.attendance-users.edit', compact('attendance', 'users', 'user'));
    }

        public function update(Request $request, AttendanceUser $attendance)
    {
        $login = Login::find(Session::get('login_id'));
        $user = $login?->loginable;
        $gym = $user->gym;
        
        if (!$user || !$user->gym) {
            return redirect('/login')->withErrors(['access' => 'Sesión inválida']);
        }

        // Cargar la relación user si no está cargada
        $attendance->load('user');

        // Verificar que el usuario de la asistencia exista
        if (!$attendance->user) {
            return back()->with('error', 'El usuario asociado a esta asistencia no existe');
        }

        // Verificar que el usuario pertenezca al gimnasio
        if ($attendance->user->gym_id !== $user->gym->id) {
            abort(403, 'No autorizado');
        }

try {
    $validated = $request->validate([
        'check_out' => 'required|date_format:H:i|after_or_equal:check_in',
    ]);

    $attendance->update([
        'check_out' => $validated['check_out'],
    ]);

            return redirect()->route('admin.attendance-users')
                        ->with('success', 'Asistencia finalizada correctamente.');
} catch (\Exception $e) {
    return redirect()->back()->with('error', 'Error al actualizar la hora de salida: '.$e->getMessage());
}

    }

    public function destroy(AttendanceUser $attendance)
    {

        $attendance->delete();

        return redirect()->route('admin.attendance-users')
                        ->with('success', 'Asistencia eliminada correctamente.');
    }
}
