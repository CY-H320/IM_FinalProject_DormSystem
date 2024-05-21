<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>編輯 {{ $student->name }} 詳細資料</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
@include('header')
<div class="container mt-5" style="padding-bottom: 80px;">
    <h2>編輯 {{ $student->name }} 詳細資料</h2>
    <form action="{{ route('student.update', $student->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">姓名</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $student->name }}" required>
        </div>
        <div class="form-group">
            <label for="studentID">學號</label>
            <input type="text" class="form-control" id="studentID" name="studentID" value="{{ $student->studentID }}" required>
        </div>
        <div class="form-group">
            <label for="email">郵件</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $student->email }}" required>
        </div>
        <div class="form-group">
            <label for="room">房位</label>
            <input type="text" class="form-control" id="room" name="room" value="{{ $student->room }}">
        </div>
        <div class="form-group">
            <label for="bed">床位</label>
            <input type="text" class="form-control" id="bed" name="bed" value="{{ $student->bed }}">
        </div>
        <div class="form-group">
            <label for="point">記點</label>
            <input type="number" class="form-control" id="point" name="point" value="{{ $student->point }}">
        </div>
        <div class="form-group">
            <label for="description">備註</label>
            <textarea class="form-control" id="description" name="description">{{ $student->description }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">更新資料</button>
        <a href="{{ route('student.index') }}" class="btn btn-secondary">取消</a>
    </form>
</div>
@include('footer')
</body>
</html>
