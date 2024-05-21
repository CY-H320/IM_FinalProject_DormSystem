<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>台灣大學住宿管理系統</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            flex-direction: column;
            position: relative;
        }

        .container {
            text-align: center;
        }

        h1 {
            color: #333;
            margin-bottom: 20px;
        }

        .btn {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            margin-right: 10px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>台灣大學住宿管理系統</h1>
        <div>
            <a href="{{ url('login') }}" class="btn">登入</a>
            <a href="{{ route('package.public') }}" class="btn">包裹</a>
            <a href="{{ route('visitors.publicCreate') }}" class="btn">訪客</a>
            <a href="{{ route('equipments.public') }}" class="btn">公共設施</a>
            <!-- <form action="/" method="post">
                @csrf
                <button type="submit">Run Python</button>
            </form> -->
        </div>
    </div>
    @include('footer')
</body>
</html>
