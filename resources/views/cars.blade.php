<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Rental</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h2>Available Cars</h2>
        <div class="row mb-3">
            <div class="col-md-3">
                <input type="text" id="brandFilter" class="form-control" placeholder="Filter by brand">
            </div>
            <div class="col-md-3">
                <input type="number" id="minPrice" class="form-control" placeholder="Min price">
            </div>
            <div class="col-md-3">
                <input type="number" id="maxPrice" class="form-control" placeholder="Max price">
            </div>
            <div class="col-md-3">
                <button class="btn btn-primary" onclick="fetchCars()">Search</button>
            </div>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Brand</th>
                    <th>Price Per Day</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="carsTable">
                @foreach ($cars as $car)
                <tr>
                    <td>{{ $car->name }}</td>
                    <td>{{ $car->brand }}</td>
                    <td>${{ $car->price_per_day }}</td>
                    <td>{{ $car->availability_status }}</td>
                    <td>
                        @if ($car->availability_status === 'available')
                            <a href="{{ route('booking.create', ['car_id' => $car->id]) }}" class="btn btn-success">Book</a>
                        @else
                            <button class="btn btn-secondary" disabled>Booked</button>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        function fetchCars() {
            let brand = $('#brandFilter').val();
            let minPrice = $('#minPrice').val();
            let maxPrice = $('#maxPrice').val();

            $.get("{{ route('cars') }}", { brand, min_price: minPrice, max_price: maxPrice }, function(data) {
                $('#carsTable').html(data);
            });
        }
    </script>
</body>
</html>
