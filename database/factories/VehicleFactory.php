<?php

namespace Database\Factories;

use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<Vehicle> */
class VehicleFactory extends Factory
{
    protected $model = Vehicle::class;

    public function definition(): array
    {
        return [
            'make'  => fake()->randomElement(['Honda', 'Subaru', 'Mazda']),
            'model' => fake()->word(),
            'year'  => fake()->numberBetween(1990, 2024),
            'price' => fake()->randomFloat(2, 5000, 150000),
        ];
    }
}
