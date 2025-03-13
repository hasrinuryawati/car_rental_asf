<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Form</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h2>Book Car: {{ $car->name }}</h2>
        <form id="bookingForm">
            @csrf
            <input type="hidden" id="car_id" value="{{ $car->id }}">
            <div class="mb-3">
                <label for="user_id" class="form-label">User ID</label>
                <input type="number" class="form-control" id="user_id" required>
            </div>
            <div class="mb-3">
                <label for="start_date" class="form-label">Start Date</label>
                <input type="date" class="form-control" id="start_date" required>
            </div>
            <div class="mb-3">
                <label for="end_date" class="form-label">End Date</label>
                <input type="date" class="form-control" id="end_date" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit Booking</button>
        </form>
        <div id="responseMessage" class="mt-3"></div>
    </div>

    <script>
        $(document).ready(function() {
            $('#bookingForm').on('submit', function(e) {
                e.preventDefault();
                var data = {
                    user_id: $('#user_id').val(),
                    car_id: $('#car_id').val(),
                    start_date: $('#start_date').val(),
                    end_date: $('#end_date').val(),
                    _token: '{{ csrf_token() }}'
                };

                $.ajax({
                    url: '{{ route("booking.store") }}',
                    type: 'POST',
                    data: data,
                    success: function(response) {
                        window.location.href = '/booking/confirmation/' + response.booking_id;
                    },
                    error: function(xhr) {
                        $('#responseMessage').html(`<div class="alert alert-danger">${xhr.responseJSON.message}</div>`);
                    }
                });
            });
        });
    </script>
</body>
</html>
