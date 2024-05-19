<!-- resources/views/search.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NTU Dormitory Admin</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
@include('header')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>學生</h2>
        <form action="{{ route('logout') }}" method="post">
            @csrf
            <button class="btn btn-danger">登出</button>
        </form>
    </div>
    <form action="{{ route('student.index') }}" method="get">
        <div class="form-row">
            <div class="col-md-4 mb-3">
                <label for="room">Room:</label>
                <select class="form-control" name="room" id="room">
                    <option value="">All Rooms</option>
                    @foreach($rooms as $room)
                        <option value="{{ $room }}">{{ $room }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label for="bed">Bed:</label>
                <select class="form-control" name="bed" id="bed">
                    <option value="">All Beds</option>
                    @foreach($beds as $bed)
                        <option value="{{ $bed }}">{{ $bed }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label for="floor">Floor:</label>
                <select class="form-control" name="floor" id="floor">
                    <option value="">All Floors</option>
                    @foreach($floors as $floor)
                        <option value="{{ $floor }}">{{ $floor }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <button class="btn btn-primary" type="submit">Search</button>
    </form>

    @if($students->isNotEmpty())
    <div class="mt-4">
        <h4>Search Results:</h4>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Room</th>
                    <th>Bed</th>
                    <th>Name</th>
                    <th>Package Count</th>
                    <th>Details</th> <!-- New column for the detail button -->
                </tr>
            </thead>
            <tbody>
                @foreach($students as $student)
                <tr>
                    <td>{{ $student->room }}</td>
                    <td>{{ $student->bed }}</td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $packageCounts[$student->id] ?? 0 }}</td>
                    <td>
                        <a href="{{ route('student.details', ['id' => $student->id]) }}" class="btn btn-primary">Details</a>
                    </td> <!-- Add a detail button linking to the student detail page -->
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <div class="mt-4">
        <p>No students found.</p>
    </div>
    @endif
</div>
@include('footer')
</body>
</html>
