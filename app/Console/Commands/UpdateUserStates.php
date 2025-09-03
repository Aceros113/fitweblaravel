<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class UpdateUserStates extends Command
{
    protected $signature = 'users:update-states';
    protected $description = 'Actualiza el estado de los usuarios según la vigencia de su membresía';

    public function handle()
{
    Log::info("Comando 'users:update-states' ejecutado.");

    $hoy = Carbon::today();

    User::with('memberships')->get()->each(function ($user) use ($hoy) {
        $membresia = $user->memberships
            ->sortByDesc('finish_date')
            ->first();

        if ($membresia) {
            if ($membresia->finish_date >= $hoy) {
                // Membresía vigente
                if ($user->state !== 'activo') {
                    $user->state = 'activo';
                    $user->save();
                    $this->info("Usuario {$user->name} marcado como ACTIVO.");
                    Log::info("Usuario {$user->name} marcado como ACTIVO.");
                }
            } else {
                // Membresía vencida
                if ($user->state !== 'inactivo') {
                    $user->state = 'inactivo';
                    $user->save();
                    $this->info("Usuario {$user->name} marcado como INACTIVO.");
                    Log::info("Usuario {$user->name} marcado como INACTIVO.");
                }
            }
        } else {
            // Sin membresía
            if ($user->state !== 'inactivo') {
                $user->state = 'inactivo';
                $user->save();
                $this->info("Usuario {$user->name} sin membresía, marcado como INACTIVO.");
                Log::info("Usuario {$user->name} sin membresía, marcado como INACTIVO.");
            }
        }
    });

    return Command::SUCCESS;
}

}    