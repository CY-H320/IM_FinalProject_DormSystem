<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $student->name }} Details</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
@include('header')
<div class="container mt-5">
    <h2>{{ $student->name }}</h2>
    <p><strong>Student ID:</strong> {{ $student->studentID }}</p>
    <p><strong>Email:</strong> {{ $student->email }}</p>
    <p><strong>Room:</strong> {{ $student->room }}</p>
    <p><strong>Bed:</strong> {{ $student->bed }}</p>

    <h3>Packages:</h3>
    @if($packages->isNotEmpty())
    <ul>
        @foreach($packages as $package)
        <li class="d-flex justify-content-between align-items-center">
            <div class="p-2">
                <span><strong>Date:</strong> {{ $package->date }}</span>
                <span><strong>Room:</strong> {{ $package->room }}</span>
                <span><strong>Bed:</strong> {{ $package->bed }}</span>
                <span><strong>Name:</strong> {{ $package->name }}</span>
            </div>
            <form action="{{ route('package.delete', $package->id) }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
            </form>
        </li>
        @endforeach
    </ul>
    @else
    <p>No packages found for this student.</p>
    @endif

    <h3>Visitors:</h3>
    @if($visitors->isNotEmpty())
    <ul>
        @foreach($visitors as $visitor)
        <li class="d-flex justify-content-between align-items-center">
            <div class="p-2">
                <span><strong>Visitor Name:</strong> {{ $visitor->visitorName }}</span>
                <span><strong>Gender:</strong> {{ $visitor->gender }}</span>
                <span><strong>Visit Time:</strong> {{ $visitor->visit_time }}</span>
                <span><strong>Exit Time:</strong> {{ $visitor->exit_time }}</span>
            </div>
            <form action="{{ route('visitors.destroy', $visitor->id) }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
            </form>
        </li>
        @endforeach
    </ul>
    @else
    <p>No visitors found for this student.</p>
    @endif

    <h3>Bookings:</h3>
    @if($bookings->isNotEmpty())
    <ul>
        @foreach($bookings as $booking)
        <li class="d-flex justify-content-between align-items-center">
            <div class="p-2">
                <span><strong>Start Time:</strong> {{ $booking->start_time }}</span>
                <span><strong>End Time:</strong> {{ $booking->end_time }}</span>
                <span><strong>Booked By:</strong> {{ $booking->booked_by }}</span>
                <span><strong>Room:</strong> {{ $booking->room }}</span>
                <span><strong>Bed:</strong> {{ $booking->bed }}</span>
            </div>
            <form action="{{ route('bookings.destroy', $booking->id) }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
            </form>
        </li>
        @endforeach
    </ul>
    @else
    <p>No bookings found for this student.</p>
    @endif

    <a href="{{ route('student.index') }}" class="btn btn-primary">Back to Students</a>
</div>

@include('footer')
</body>
</html>
