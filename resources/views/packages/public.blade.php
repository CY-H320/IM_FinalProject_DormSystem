<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NTU Dormitory Admin</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">NTU Dormotory Admin</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
</nav>
<div class="container mt-5">
    <h2>包裹</h2>
    <form action="{{ route('package.public') }}" method="get">
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
        </div>
        <button class="btn btn-primary" type="submit">Search</button>
    </form>
    

    @if($packages->isNotEmpty())
    <div class="mt-4">
        <h4>Packages:</h4>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Room</th>
                    <th>Bed</th>
                    <th>Name</th>
                </tr>
            </thead>
            <tbody>
                @foreach($packages as $package)
                <tr>
                    <td>{{ $package->date }}</td>
                    <td>{{ $package->room }}</td>
                    <td>{{ $package->bed }}</td>
                    <td>{{ $package->name }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <p>No packages found.</p>
    @endif
</div>

</body>
</html>
