<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ReceptionistController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AttendanceUserController;
use App\Http\Controllers\AttendanceCoachController;

Route::get('/', fn () => view('inicio'));
Route::get('contactanos', fn () => view('contactanos'));
Route::get('sobre-nosotros', fn () => view('sobre-nosotros'));
Route::get('funcionalidades', fn () => view('funcionalidades'));

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('custom.login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// ADMIN
Route::middleware(['role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/dashboard/users', [UserController::class, 'dashboard'])->name('admin.users.dashboard');
    Route::get('/dashboard/user-stats', [UserController::class, 'userStats'])->name('user.stats');
    Route::get('/dashboard/users-by-month', [UserController::class, 'usersByMonth']);

    Route::resource('users', UserController::class)->names([...]);
    Route::resource('memberships', MembershipController::class)->names([...]);
    Route::resource('payments', PaymentController::class)->names([...]);
    Route::resource('attendance-coaches', AttendanceCoachController::class)->names([...]);
    Route::resource('attendance-users', AttendanceUserController::class)->names([...]);
});

// RECEPTIONIST
Route::middleware(['role:receptionist'])->prefix('receptionist')->group(function () {
    Route::get('/dashboard', [ReceptionistController::class, 'dashboard'])->name('receptionist.dashboard');

    Route::resource('users', UserController::class)->names([...]);
    Route::resource('memberships', MembershipController::class)->names([...]);
    Route::resource('payments', PaymentController::class)->names([...]);
    Route::resource('attendance-users', AttendanceUserController::class)->names([...]);
});

// (opcional) para usuarios normales
Route::middleware(['role:user'])->get('/dashboard', [PaymentController::class, 'dashboard'])->name('dashboard');


Route::get('/dashboard', [PaymentController::class, 'dashboard'])->name('dashboard');
