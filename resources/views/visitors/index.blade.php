<!-- resources/views/visitors/index.blade.php -->

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
    <h2>訪客</h2>

    <form action="{{ route('visitors.index') }}" method="get">
        <div class="form-row">
            <div class="col-md-4 mb-3">
                <label for="room">Room:</label>
                <select class="form-control" name="room" id="room">
                    <option value="">All Rooms</option>
                    @foreach($roomOptions as $room)
                        <option value="{{ $room }}">{{ $room }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label for="bed">Bed:</label>
                <select class="form-control" name="bed" id="bed">
                    <option value="">All Beds</option>
                    @foreach($bedOptions as $bed)
                        <option value="{{ $bed }}">{{ $bed }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 mb-3">
                <label for="studentID">ID:</label>
                <input type="text" class="form-control" name="studentID" id="studentID" placeholder="Enter student ID">
            </div>
        </div>
        <button class="btn btn-primary" type="submit">Search</button>
        <a href="{{ route('visitors.create') }}" class="btn btn-success">Add Visitor</a>
    </form>
    

    @if($visitors->isNotEmpty())
    <div class="mt-4">
        <h4>Visitors:</h4>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Visitor Name</th>
                    <th>Visitor Gender</th>
                    <th>Visit Time</th>
                    <th>Room</th>
                    <th>Bed</th>
                    <th>Student Name</th>
                    <th>Student ID</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($visitors as $visitor)
                <tr>
                    <td>{{ $visitor->visitorName }}</td>
                    <td>{{ $visitor->gender }}</td>
                    <td>{{ $visitor->visit_time }}</td>
                    <td>{{ $visitor->room }}</td>
                    <td>{{ $visitor->bed }}</td>
                    <td>{{ $visitor->student_name }}</td>
                    <td>
                    @if ($visitor->student)
                        <a href="{{ route('student.details', $visitor->student->id) }}">{{ $visitor->student->studentID }}</a>
                    @else
                        N/A
                    @endif
                    </td>
                    <td>
                        <form action="{{ route('visitors.destroy', $visitor->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <p>No visitors found.</p>
    @endif
</div>

</body>
</html>
