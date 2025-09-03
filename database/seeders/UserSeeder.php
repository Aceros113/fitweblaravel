<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $nombresMasculinos = ['Juan', 'Carlos', 'Luis', 'Pedro', 'Miguel', 'Jorge', 'Fernando', 'Ricardo', 'Oscar', 'Raúl'];
        $nombresFemeninos = ['María', 'Ana', 'Sofía', 'Elena', 'Patricia', 'Isabel', 'Adriana', 'Gabriela', 'Claudia', 'Lucía'];
        $apellidos = ['Pérez', 'García', 'López', 'Martínez', 'Rodríguez', 'Hernández', 'González', 'Sánchez', 'Ramírez', 'Flores'];

        $cedulasUsadas = [];

        for ($i = 0; $i < 20; $i++) {
            $genero = $i % 2 == 0 ? 'M' : 'F';
            $nombre = $genero == 'M'
                ? $faker->randomElement($nombresMasculinos)
                : $faker->randomElement($nombresFemeninos);
            $apellido1 = $faker->randomElement($apellidos);
            $apellido2 = $faker->randomElement($apellidos);

            // Generar cédula única entre 10000000 y 999999999
            do {
                $cedula = $faker->unique()->numberBetween(10000000, 999999999);
            } while (in_array($cedula, $cedulasUsadas));

            $cedulasUsadas[] = $cedula;

            User::create([
                'id' => $cedula,
                'name' => "$nombre $apellido1 $apellido2",
                'gender' => $genero,
                'birth_date' => $faker->date('Y-m-d', '2003-01-01'),
                'phone_number' => '3' . $faker->numerify('########'),
                'email' => strtolower("$nombre.$apellido1.$i@gmail.com"),
                'state' => $faker->randomElement(['Activo', 'Inactivo']),
                'gym_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
