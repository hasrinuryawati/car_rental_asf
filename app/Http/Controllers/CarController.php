<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CarController extends Controller
{
    public function listView() {
        return view('cars');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Car::query();
        if ($request->has('brand')) {
            $query->where('brand', $request->brand);
        }

        if ($request->has('min_price') && $request->has('max_price')) {
            $query->whereBetween('price_per_day', [$request->min_price, $request->max_price]);
        }

        if ($request->has('availability_status')) {
            $query->where('availability_status', $request->availability_status);
        }

        $cacheKey = 'cars_' . md5(json_encode($request->all()));

        $cars = Cache::remember($cacheKey, 600, function () use ($query) {
            return $query->get();
        });

        return view('cars', ['cars' => $cars]);
    }
}
