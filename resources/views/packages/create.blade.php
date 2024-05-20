<!-- resources/views/packages/create.blade.php -->

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
    <h2>包裹</h2>
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <form action="{{ route('package.store') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="date">日期：</label>
            <input type="date" id="date" name="date" class="form-control">
        </div>
        <div class="form-group">
            <label for="room">房間：</label>
            <input type="text" id="room" name="room" class="form-control">
        </div>
        <div class="form-group">
            <label for="bed">床位：</label>
            <input type="text" id="bed" name="bed" class="form-control">
        </div>
        <div class="form-group">
            <label for="name">名字：</label>
            <input type="text" id="name" name="name" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">新增包裹</button>
        <a href="{{ route('packages.index') }}" class="btn btn-success">返回</a>
    </form>
</div>

</body>
</html>
