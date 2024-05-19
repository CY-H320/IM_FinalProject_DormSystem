<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Equipment Booking Schedule</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
@include('header')
<div class="container mt-5">
    <h2>Equipment Booking Schedule</h2>

    @foreach($equipments as $equipment)
        <h3>{{ $equipment->name }}</h3>
        <p>{{ $equipment->description }}</p>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Booked By</th>
                </tr>
            </thead>
            <tbody>
                @forelse($equipment->bookings as $booking)
                    <tr>
                        <td>{{ $booking->start_time }}</td>
                        <td>{{ $booking->end_time }}</td>
                        <td>{{ $booking->booked_by }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">No bookings found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    @endforeach

    <a href="{{ route('bookings.create') }}" class="btn btn-success">Book Equipment</a>
</div>
</body>
</html>
