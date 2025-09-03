<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\Login;
class AdminSeeder extends Seeder
{
    public function run()
    {
        $admin = Admin::create([
            'name' => 'Super Admin',
            'phone' => '3210000000',
            // otros campos necesarios
        ]);
    
        Login::create([
            'email' => 'admin@email.com',
            'password' => Hash::make('secreto123'),
            'loginable_id' => $admin->id,
            'loginable_type' => Admin::class,
        ]);
    }
}



