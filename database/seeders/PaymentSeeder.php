<?php

namespace Database\Seeders;

use App\Models\Payment;
use App\Models\User;
use App\Models\Membership;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
    
        // Obtener todas las membresías con su relación al usuario
        $memberships = Membership::with('user')->get();
    
        if ($memberships->isEmpty()) {
            $this->command->warn('No memberships found. Please seed memberships first.');
            return;
        }
    
        // Crear 20 pagos
        for ($i = 0; $i < 20; $i++) {
            $membership = $memberships->random();
    
            Payment::create([
                'date' => $faker->dateTimeBetween('-6 months', 'now')->format('Y-m-d'),
                'amount' => $faker->randomFloat(2, 30000, 1000000),
                'payment_method' => $faker->randomElement(['Efectivo', 'Bancolombia', 'Nequi']),
                'user_id' => $membership->user_id,
                'membership_id' => $membership->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
    
}
