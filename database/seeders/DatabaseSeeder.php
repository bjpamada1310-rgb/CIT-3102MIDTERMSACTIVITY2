<?php

namespace Database\Seeders;

use App\Models\Vehicle;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $vehicles = [
            ['make' => 'Mitsubishi', 'model' => 'Lancer Evolution VI', 'year' => 1999, 'price' => 45000.00],
            ['make' => 'Nissan',     'model' => 'Skyline GT-R R34',    'year' => 1999, 'price' => 120000.00],
            ['make' => 'Toyota',     'model' => 'GR Supra',            'year' => 2021, 'price' => 55000.00],
        ];

        foreach ($vehicles as $vehicle) {
            Vehicle::create($vehicle);
        }
    }
}
