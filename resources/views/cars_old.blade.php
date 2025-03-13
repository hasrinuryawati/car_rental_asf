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
            <tbody id="carList">
                @foreach ($cars as $data)
                <tr>
                    <td>{{ $data->name }}</td>
                    <td>{{ $data->brand }}</td>
                    <td>{{ $data->price_per_day }}</td>
                    <td>{{ $data->availability_status }}</td>
                    <td>
                        @if ($data->availability_status === 'available')
                            <a href="{{ route('booking.form', $data->id) }}" class="btn btn-success">Book Now</a>
                        @else
                            <button class="btn btn-secondary" disabled>Not Available</button>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        function fetchCars() {
            var brand = $('#brandFilter').val();
            var minPrice = $('#minPrice').val();
            var maxPrice = $('#maxPrice').val();

            $.ajax({
                url: '{{ route("cars.list") }}',
                type: 'GET',
                data: {brand: brand, min_price: minPrice, max_price: maxPrice},
                success: function(response) {
                    var rows = '';
                    response.forEach(function(car) {
                        rows += `
                            <tr>
                                <td>${car.name}</td>
                                <td>${car.brand}</td>
                                <td>${car.price_per_day}</td>
                                <td>${car.availability_status}</td>
                                <td>
                                    ${car.availability_status === 'available' ?
                                        `<a href="/booking/forms/${car.id}" class="btn btn-success">Book Now</a>`:
                                        `<button class="btn btn-secondary" disabled>Not Available</button>`}
                                </td>
                            </tr>`;
                    });
                    $('#carList').html(rows);
                }
            });
        }
    </script>
</body>
</html>
