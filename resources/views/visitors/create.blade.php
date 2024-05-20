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
@include('header')
<div class="container mt-5">
    <h2>訪客</h2>
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <form action="{{ route('visitors.store') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="visitorName">訪客姓名：</label>
            <input type="text" id="visitorName" name="visitorName" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="gender">訪客性別：</label>
            <select id="gender" name="gender" class="form-control" required>
                <option value="">選取性別⋯⋯</option>
                <option value="男">男</option>
                <option value="女">女</option>
                <option value="其他">其他</option>
            </select>
        </div>
        <div class="form-group">
            <label for="student_id">住宿生學號：</label>
            <input type="text" id="student_id" name="student_id" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="room">房間：</label>
            <input type="text" id="room" name="room" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="bed">床位：</label>
            <input type="text" id="bed" name="bed" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">登記</button>
        <a href="{{ route('visitors.index') }}" class="btn btn-success">返回</a>
    </form>
</div>

</body>
</html>
