<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $student->name }} 詳細資料</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
@include('header')
<div class="container mt-5" style="padding-bottom: 80px;">
    <h2>{{ $student->name }}</h2>
    <p><strong>學號：</strong> {{ $student->studentID }}</p>
    <p>
        <strong>郵件：</strong>
        <button id="copyEmailButton" class="btn btn-link p-0 m-0">{{ $student->email }}</button>
    </p>
    <p><strong>房位：</strong> {{ $student->room }}</p>
    <p><strong>床位：</strong> {{ $student->bed }}</p>
    <p><strong>記點：</strong> {{ $student->point }}</p>
    <p><strong>備註：</strong> {{ $student->description }}</p>
    <h3>包裹：</h3>
    @if($packages->isNotEmpty())
    <ul>
        @foreach($packages as $package)
        <li class="d-flex justify-content-between align-items-center">
            <div class="p-2">
                <span><strong>日期：</strong> {{ $package->date }}</span>
                <span><strong>名字：</strong> {{ $package->name }}</span>
            </div>
            <form action="{{ route('package.delete', $package->id) }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
            </form>
        </li>
        @endforeach
    </ul>
    @else
    <p>無包裹</p>
    @endif

    <h3>訪客：</h3>
    @if($visitors->isNotEmpty())
    <ul>
        @foreach($visitors as $visitor)
        <li class="d-flex justify-content-between align-items-center">
            <div class="p-2">
                <span><strong>訪客姓名：</strong> {{ $visitor->visitorName }}</span>
                <span><strong>訪客性別：</strong> {{ $visitor->gender }}</span>
                <span><strong>訪客拜訪時間：</strong> {{ $visitor->visit_time }}</span>
            </div>
            <form action="{{ route('visitors.destroy', $visitor->id) }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger">訪客離開</button>
            </form>
        </li>
        @endforeach
    </ul>
    @else
    <p>No visitors found for this student.</p>
    @endif

    <h3>登記借用：</h3>
    @if($bookings->isNotEmpty())
    <ul>
        @foreach($bookings as $booking)
        <li class="d-flex justify-content-between align-items-center">
            <div class="p-2">
                <span><strong>物品：</strong> {{ $booking->name }}</span>
                <span><strong>借用時間：</strong> {{ $booking->start_time }}</span>
                <span><strong> - </strong> {{ $booking->end_time }}</span>
            </div>
            <form action="{{ route('bookings.destroy', $booking->id) }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger">借用完畢</button>
            </form>
        </li>
        @endforeach
    </ul>
    @else
    <p>無物品借用</p>
    @endif
    <a href="{{ route('student.edit', $student->id) }}" class="btn btn-info">編輯資料</a>
    <a href="{{ route('student.index') }}" class="btn btn-primary">回學生頁面</a>
</div>

@include('footer')
</body>

<script>
    document.getElementById("copyEmailButton").addEventListener("click", function() {
        var emails = [];
        emails.push("{{ $student->email }}");
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
