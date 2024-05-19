<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Equipment</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
@include('header')
<div class="container mt-5">
    <h2>Book Equipment</h2>

    <form action="{{ route('bookings.store') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="equipment_id">Equipment:</label>
            <select id="equipment_id" name="equipment_id" class="form-control" required>
                @foreach($equipments as $equipment)
                    <option value="{{ $equipment->id }}">{{ $equipment->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="start_time">Start Time:</label>
            <input type="datetime-local" id="start_time" name="start_time" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="end_time">End Time:</label>
            <input type="datetime-local" id="end_time" name="end_time" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="booked_by">Booked By:</label>
            <input type="text" id="booked_by" name="booked_by" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Book</button>
        <a href="{{ route('equipments.index') }}" class="btn btn-secondary">Back to Schedule</a>
    </form>
</div>
</body>
</html>
