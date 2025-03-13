<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Car;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $cars = Car::all();
        $statuses = ['pending', 'confirmed', 'completed', 'canceled'];

        for ($i=0; $i < 2000; $i++) {
            $user = $users->random();
            $car = $cars->random();
            $start_date = Carbon::now()->subDays(rand(0, 30));
            $end_date = (clone $start_date)->addDays(rand(1, 7));
            $total_price = $car->price_per_day * $start_date->diffInDays($end_date);

            Booking::create([
                'user_id' => $user->id,
                'car_id' => $car->id,
                'start_date' => $start_date,
                'end_date' => $end_date,
                'total_price' => $total_price,
                'status' => $statuses[array_rand($statuses)]
            ]);
        }
    }
}
