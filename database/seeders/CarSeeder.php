<?php

namespace Database\Seeders;

use App\Models\Car;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = ['Honda', 'Toyota', 'Suzuki', 'Nissan', 'Mazda', 'Daihatsu', 'Chevrolet', 'Hyundai', 'Volvo', 'BMW'];

        Car::factory(1000)->create([
            'brand' => fn() => $brands[array_rand($brands)]
        ]);
    }
}
