@component('mail::message')
# Booking Status Update

Hello {{ $booking->user->name }},

Your booking for **{{ $booking->motorcycle->name }}** (Brand: {{ $booking->motorcycle->brand }})
from **{{ $booking->start_date }}** to **{{ $booking->end_date }}**
has been **{{ ucfirst($booking->status) }}**.

@if($booking->status == 'confirmed')
@component('mail::button', ['url' => 'https://your-rental-site.com/bookings/' . $booking->id])
View Booking
@endcomponent
@endif

Thanks,
{{ config('app.name') }}
@endcomponent
