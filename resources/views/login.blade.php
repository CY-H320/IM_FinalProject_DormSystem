<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NTU Dormitory Admin</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 40px;
            width: 300px;
            text-align: center;
            position: relative;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="password"] {
            width: calc(100% - 20px);
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="submit"] {
            font-size: 14px;
            width: 100%;
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 6px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .return {
            font-size: 14px;
            width: 100%;
            display: inline-block;
            background-color: #ccc; /* Change button color to gray */
            color: #fff;
            padding: 6px 0px;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease;
            margin: 5px 0px; /* Adjust margin to separate the buttons */
        }

        .return:hover {
            background-color: #999; /* Darken the button color on hover */
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .error-message {
            color: red;
            margin-top: 10px;
            position: absolute;
            top: 100%;
            left: 0;
            width: 100%;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        @if ($errors->has('fail'))
            <div class="error-message">{{ $errors->first('fail') }}</div>
        @endif
        <form action="{{ url('login') }}" method="POST" class="form">
            @csrf
            <div class="form-group">
                <label for="name">名字</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required>
            </div>
            <div class="form-group">
                <label for="password">密碼</label>
                <input type="password" id="password" name="password" value="{{ old('password') }}" required>
            </div>
            <input type="submit" value="登入">
        </form>
        <a href="{{ url('/') }}" class="return">返回</a>
    </div>
    @include('footer')
</body>
</html>
