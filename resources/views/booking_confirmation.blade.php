<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h2>Booking Confirmation</h2>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Car: {{ $booking->car->name }}</h5>
                <p><strong>Brand:</strong> {{ $booking->car->brand }}</p>
                <p><strong>Start Date:</strong> {{ $booking->start_date }}</p>
                <p><strong>End Date:</strong> {{ $booking->end_date }}</p>
                <p><strong>Total Price:</strong> ${{ $booking->total_price }}</p>
                <p><strong>Status:</strong> {{ $booking->status }}</p>
            </div>
        </div>
        <a href="{{ route('cars') }}" class="btn btn-primary mt-3">Back to Cars List</a>
    </div>
</body>
</html>
