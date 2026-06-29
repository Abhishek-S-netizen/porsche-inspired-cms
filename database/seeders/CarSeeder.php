<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Car;
use App\Models\Variant;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
{
    $car = Car::create([
        'name' => '911',
        'slug' => '911',
    ]);

    $car->variants()->createMany([
        [
            'variant' => 'Turbo S',
            'slug' => 'turbo-s',
            'year' => 2024,
            'fuel_type' => 'Petrol',
            'gearbox' => 'PDK',
        ],
        [
            'variant' => 'Carrera',
            'slug' => 'carrera',
            'year' => 2024,
            'fuel_type' => 'Petrol',
            'gearbox' => 'Manual',
        ]
    ]);
}
}
