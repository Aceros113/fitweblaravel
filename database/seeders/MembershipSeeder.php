<?php

namespace Database\Seeders;

use App\Models\Membership;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Support\Carbon;

class MembershipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Generar 20 membresías
        for ($i = 0; $i < 20; $i++) {
            Membership::create([
                'type' => $faker->randomElement(['Anual', 'Semestral', 'Mensual', 'Diaria']), // Aleatoriza el tipo de membresía
                'amount' => $faker->numberBetween(50000, 1000000), // Monto aleatorio entre 50,000 y 1,000,000
                'discount' => $faker->numberBetween(0, 200000), // Descuento aleatorio entre 0 y 200,000
                'start_date' => $faker->date($format = 'Y-m-d', $max = 'now'), // Fecha de inicio aleatoria hasta el día de hoy
                'finish_date' => now()->addYear(), // Fecha de finalización dentro de un año
                'user_id' => User::inRandomOrder()->first()->id, // Relacionar con un usuario aleatorio (ahora usando el id como cédula)
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
