<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Arch & Art</title>
    @vite('resources/css/app.css')
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f8fafc;
            color: #333;
            text-align: center;
            padding: 50px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .menu a {
            display: inline-block;
            margin: 10px;
            padding: 10px 20px;
            text-decoration: none;
            color: #fff;
            background: #007bff;
            border-radius: 5px;
            transition: background 0.3s;
        }
        .menu a:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome to Arch & Art</h1>
        @if (session('success'))
            <p class="success-message">{{ session('success') }}</p>
            
        @endif
        <div class="menu">
            <a href="{{ route('receptionist.create') }}">Create Token</a>
            <a href="{{ route('cre.index') }}">View Tokens</a>
            <form method="POST" action="/api/reset-tokens">
            @csrf
            <button type="submit" class="menu" style="background-color: red;">Reset Tokens</button>
        </form>
        </div>
    </div>
    @vite('resources/js/app.js')
</body>
</html>
