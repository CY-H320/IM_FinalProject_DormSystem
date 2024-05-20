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
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>學生</h2>
    </div>
    <form action="{{ route('student.index') }}" method="get">
        <div class="form-row">
            <div class="col-md-3 mb-3">
                <label for="room">房間</label>
                <select class="form-control" name="room" id="room">
                    <option value="">所有房間</option>
                    @foreach($rooms as $room)
                        <option value="{{ $room }}">{{ $room }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 mb-3">
                <label for="bed">床位</label>
                <select class="form-control" name="bed" id="bed">
                    <option value="">所有床位</option>
                    @foreach($beds as $bed)
                        <option value="{{ $bed }}">{{ $bed }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 mb-3">
                <label for="floor">樓層</label>
                <select class="form-control" name="floor" id="floor">
                    <option value="">所有樓層</option>
                    @foreach($floors as $floor)
                        <option value="{{ $floor }}">{{ $floor }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 mb-3">
                <label for="studentID">學號</label>
                <input type="text" class="form-control" name="studentID" id="studentID" placeholder="搜尋學號">
            </div>
        </div>
        <button class="btn btn-primary" type="submit">搜尋</button>
        <button id="copyEmailButton" class="btn btn-warning">複製郵件</button>
    </form>

    @if($students->isNotEmpty())
    <div class="mt-4">
        <h4>學生：</h4>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>房間</th>
                    <th>床位</th>
                    <th>名字</th>
                    <th>包裹數量</th>
                    <th>訪客數量</th>
                    <th>借用登記</th>
                    <th>詳細資料</th>
                </tr>
            </thead>
            <tbody>
                @foreach($students as $student)
                <tr>
                    <td>{{ $student->room }}</td>
                    <td>{{ $student->bed }}</td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $packageCounts[$student->id] ?? 0 }}</td>
                    <td>{{ $visitorCounts[$student->id] ?? 0 }}</td>
                    <td>{{ $bookingCounts[$student->id] ?? 0 }}</td>
                    <td>
                        <a href="{{ route('student.details', ['id' => $student->id]) }}" class="btn btn-primary">查看</a>
                    </td>
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
<script>
    document.getElementById("copyEmailButton").addEventListener("click", function() {
        var emails = [];
        @foreach($students as $student)
            emails.push("{{ $student->email }}");
        @endforeach

        var textarea = document.createElement("textarea");
        textarea.value = emails.join("\n");
        document.body.appendChild(textarea);
        textarea.select();
        document.execCommand("copy");
        document.body.removeChild(textarea);

        alert("成功複製郵件！");
    });
</script>
</html>
