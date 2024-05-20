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
    <div class="pt-2 pb-3">
        <a href="{{ route('bookings.create') }}" class="btn btn-success">登記</a>
    </div>
    <div class="row">
        @foreach($equipments as $equipment)
            <div class="col-md-12 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">{{ $equipment->name }}</h3>
                        <p class="card-text">{{ $equipment->description }}</p>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>開始借用時間</th>
                                    <th>結束借用時間</th>
                                    <th>借用學號</th>
                                    <th>房間</th>
                                    <th>床位</th>
                                    <th>刪除</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($equipment->bookings as $booking)
                                    <tr>
                                        <td>{{ $booking->start_time }}</td>
                                        <td>{{ $booking->end_time }}</td>
                                        <td>
                                            @if ($booking->student)
                                                <a href="{{ route('student.details', $booking->student->id) }}">{{ $booking->student->studentID }}</a>
                                            @else
                                                N/A
                                            @endif
                                        </td>                                        
                                        <td>{{ $booking->student->room ?? 'N/A' }}</td>
                                        <td>{{ $booking->student->bed ?? 'N/A' }}</td>
                                        <td>
                                            <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">借用完畢</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">無借用登記</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
