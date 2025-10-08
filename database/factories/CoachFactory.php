<?php

namespace Database\Factories;

use App\Models\Coach;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Carbon\Carbon;

/**
 * Class CoachFactory
 *
 * Fábrica para generar instancias de Coach para pruebas o seeders.
 *
 * @package Database\Factories
 */
class CoachFactory extends Factory
{
    /**
     * El modelo correspondiente a esta fábrica.
     *
     * @var string
     */
    protected $model = Coach::class;

    /**
     * Define el estado por defecto del modelo.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'         => $this->faker->name(),
            'gender'       => $this->faker->randomElement(['male', 'female', 'other']),
            'phone_number' => $this->faker->phoneNumber(),
            'birth_date'   => $this->faker->dateTimeBetween('-60 years', '-20 years')->format('Y-m-d'),
            'gym_id'       => 1, // Asignar un gym válido
        ];
    }
}
