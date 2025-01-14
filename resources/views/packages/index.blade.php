<!-- resources/views/packages/index.blade.php -->

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
<div class="container mt-5" style="padding-bottom: 80px;">
    <h2>包裹</h2>

    <!-- Add button to navigate to create page -->

    <form action="{{ route('packages.index') }}" method="get">
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
        </div>
        <button class="btn btn-primary" type="submit">搜尋</button>
        <a href="{{ route('package.create') }}" class="btn btn-success">新增包裹</a>
        <button id="copyEmailButton" class="btn btn-warning">複製郵件</button>
    </form>


    @if($packages->isNotEmpty())
    <div class="mt-4">
        <h4>包裹：
        </h4>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>日期</th>
                    <th>房間</th>
                    <th>床位</th>
                    <th>名字</th>
                    <th>學號</th>
                    <th>刪除</th> <!-- New column for delete button -->
                </tr>
            </thead>
            <tbody>
                @foreach($packages as $package)
                <tr>
                    <td>{{ $package->date }}</td>
                    <td>{{ $package->room }}</td>
                    <td>{{ $package->bed }}</td>
                    <td>{{ $package->name }}</td>
                    <td>
                    @if ($package->student)
                        <a href="{{ route('student.details', $package->student->id) }}">{{ $package->student->studentID }}</a>
                    @else
                        N/A
                    @endif
                    </td>
                    <td>
                        <form action="{{ route('packages.destroy', $package->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">已領取</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <p>無包裹</p>
    @endif
</div>
</body>

<script>
    document.getElementById("copyEmailButton").addEventListener("click", function() {
        var emailsSet = new Set();
        @foreach($packages as $package)
            @if($package->student)
                emailsSet.add("{{ $package->student->email }}"); // Add email to the Set
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
