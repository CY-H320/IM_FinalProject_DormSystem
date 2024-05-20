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
    <h2>登記借用</h2>
    <form action="{{ route('bookings.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="equipment">選取借用項目</label>
            <select class="form-control" id="name" name="name" required>
                @foreach($equipments as $equipment)
                <option value="{{ $equipment->name }}">{{ $equipment->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="date">日期</label>
            <select class="form-control" id="date" name="date" required>
                @php
                $startDate = now();
                $endDate = now()->addDays(7);
                @endphp
                @while($startDate <= $endDate)
                <option value="{{ $startDate->format('Y-m-d') }}">{{ $startDate->format('l, M d, Y') }}</option>
                @php $startDate->addDay(); @endphp
                @endwhile
            </select>
        </div>
        <div class="form-group">
            <label for="start_time">開始借用時間</label>
            <select class="form-control" id="start_time" name="start_time" required>
                @for ($hour = 0; $hour < 24; $hour++)
                    @for ($minute = 0; $minute < 60; $minute += 60)
                        <option value="{{ sprintf('%02d:%02d', $hour, $minute) }}">{{ sprintf('%02d:%02d', $hour, $minute) }}</option>
                    @endfor
                @endfor
            </select>
        </div>
        <div class="form-group">
            <label for="end_time">結束借用時間</label>
            <select class="form-control" id="end_time" name="end_time" required>
                @for ($hour = 0; $hour < 24; $hour++)
                    @for ($minute = 0; $minute < 60; $minute += 60)
                        <option value="{{ sprintf('%02d:%02d', $hour, $minute) }}">{{ sprintf('%02d:%02d', $hour, $minute) }}</option>
                    @endfor
                @endfor
            </select>
        </div>
        <div class="form-group">
            <label for="student_id">借用學號</label>
            <input type="text" class="form-control" id="student_id" name="student_id" required>
        </div>
        <button type="submit" class="btn btn-primary">借用</button>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
