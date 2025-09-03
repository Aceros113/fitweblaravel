<?php

namespace Database\Seeders;

use App\Models\Login;
use App\Models\Receptionist;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ReceptionistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $receptionist= Receptionist::create([
            'name' => 'Super Receptionist',
            'phone' => '3210000000',
            'admin_id' => 1, // ID del administrador al que pertenece
            // otros campos necesarios
        ]);

        Login::create([
            'email' => 'receptionist@email.com',
            'password' => Hash::make('secreto123'),
            'loginable_id' => $receptionist->id,
            'loginable_type' => Receptionist::class,
        ]);
    }
}
