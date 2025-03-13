<?php

namespace Database\Factories;

use App\Models\Car;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Car>
 */
class CarFactory extends Factory
{
    protected $model = Car::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->word(),
            'brand' => fake()->randomElement(['Honda', 'Toyota', 'Suzuki', 'Nissan', 'Mazda', 'Daihatsu', 'Chevrolet', 'Hyundai', 'Volvo', 'BMW']),
            'price_per_day' => fake()->randomFloat(2, 100000, 500000),
            'availability_status' => fake()->randomElement(['available', 'booked']),
        ];
    }
}
