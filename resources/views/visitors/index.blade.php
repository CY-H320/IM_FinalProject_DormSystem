<!-- resources/views/visitors/index.blade.php -->

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

    <form action="{{ route('visitors.index') }}" method="get">
        <div class="form-row">
            <div class="col-md-4 mb-3">
                <label for="room">房間</label>
                <select class="form-control" name="room" id="room">
                    <option value="">所有房間</option>
                    @foreach($roomOptions as $room)
                        <option value="{{ $room }}">{{ $room }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label for="bed">床位</label>
                <select class="form-control" name="bed" id="bed">
                    <option value="">所有床位</option>
                    @foreach($bedOptions as $bed)
                        <option value="{{ $bed }}">{{ $bed }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 mb-3">
                <label for="studentID">學號</label>
                <input type="text" class="form-control" name="studentID" id="studentID" placeholder="搜尋學號">
            </div>
        </div>
        <button class="btn btn-primary" type="submit">搜尋</button>
        <a href="{{ route('visitors.create') }}" class="btn btn-success">訪客登記</a>
        <button id="copyEmailButton" class="btn btn-warning">複製郵件</button>
    </form>
    

    @if($visitors->isNotEmpty())
    <div class="mt-4">
        <h4>訪客：</h4>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>訪客姓名</th>
                    <th>訪客性別</th>
                    <th>訪客拜訪時間</th>
                    <th>房間</th>
                    <th>床位</th>
                    <th>住宿生姓名</th>
                    <th>住宿生學號</th>
                    <th>刪除</th>
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
                            <button type="submit" class="btn btn-danger">刪除</button>
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

<script>
    document.getElementById("copyEmailButton").addEventListener("click", function() {
        var emailsSet = new Set();
        @foreach($visitors as $visitor)
            @if($visitor->student)
                emailsSet.add("{{ $visitor->student->email }}"); // Add email to the Set
            @endif
        @endforeach

        // Convert Set to array
        var emailsArray = Array.from(emailsSet);

        // Copy emails to clipboard
        var textarea = document.createElement("textarea");
        textarea.value = emailsArray.join("\n");
        document.body.appendChild(textarea);
        textarea.select();
        document.execCommand("copy");
        document.body.removeChild(textarea);

        alert("成功複製郵件！");
    });
</script>
</html>
