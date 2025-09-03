<?php

use Illuminate\Database\Eloquent\Factories\Factory;

class CoachFactory extends Factory
{
    protected $model = \App\Models\Coach::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'gender' => $this->faker->randomElement(['male', 'female', 'other']),
            'phone_number' => $this->faker->phoneNumber,
            'birth_date' => $this->faker->date('Y-m-d', now()->subYears(20)),
            'gyms_id' => 1,
        ];
    }
}

