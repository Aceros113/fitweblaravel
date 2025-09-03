<?php

namespace Database\Seeders;

use App\Models\Membership;
use App\Models\Receptionist;
use Illuminate\Database\Seeder;
use Database\Seeders\AdminSeeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Llamar a otros seeders aquí
        $this->call(AdminSeeder::class);
        $this->call(ReceptionistSeeder::class);
        $this->call(GymSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(MembershipSeeder::class);
        $this->call(PaymentSeeder::class);
    }
}
