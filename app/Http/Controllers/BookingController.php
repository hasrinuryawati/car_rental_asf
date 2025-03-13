<?php

namespace App\Http\Controllers;

use App\Jobs\BookingNotification;
use App\Models\Booking;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Queue;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $car = Car::findOrFail($request->car_id);
        return view('booking_create', compact('car'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'car_id' => 'required|exists:cars,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        $car = Car::find($request->car_id);
        if ($car->availability_status !== 'available') {
            return response()->json([
                'message' => 'Cars not available'
            ], 400);
        }

        $days = (new \DateTime($request->start_date))->diff(new \DateTime($request->end_date))->days;
        $total_price = $car->price_per_day * $days;

        $booking = Booking::create([
            'user_id' => $request->user_id,
            'car_id' => $request->car_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'total_price' => $total_price,
            'status' => 'pending',
        ]);

        $car->update(['availability_status' => 'booked']);

        Cache::forget('available_cars');

        Queue::push(new BookingNotification($booking));

        return redirect()->route('bookings.show', $booking->id);
    }

    public function show($id)
    {
        $booking = Booking::with('car', 'user')->findOrFail($id);
        return view('booking_confirmation', compact('booking'));
    }

    public function list()
    {
        $list = Booking::selectRaw('status, COUNT(*) as count, SUM(total_price) as revenue')
                ->groupBy('status')
                ->get();

        return response()->json($list);
    }

}
