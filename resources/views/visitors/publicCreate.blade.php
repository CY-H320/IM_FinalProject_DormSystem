<!-- resources/views/visitors/create.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>台灣大學住宿管理系統</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">台灣大學住宿管理系統</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
</nav>
<div class="container mt-5">
    <h2>訪客</h2>
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <form action="{{ route('visitors.publicStore') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="visitorName">Visitor Name:</label>
            <input type="text" id="visitorName" name="visitorName" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="gender">Visitor Gender:</label>
            <select id="gender" name="gender" class="form-control" required>
                <option value="">Select Gender</option>
                <option value="男">男</option>
                <option value="女">女</option>
                <option value="其他">其他</option>
            </select>
        </div>
        <div class="form-group">
            <label for="student_id">Student ID:</label>
            <input type="text" id="student_id" name="student_id" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="room">Room:</label>
            <input type="text" id="room" name="room" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="bed">Bed:</label>
            <input type="text" id="bed" name="bed" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Visitor</button>
    </form>
</div>

</body>
</html>
