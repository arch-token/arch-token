<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Token</title>
    @vite('resources/css/app.css')
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f8fafc;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            text-align: center;
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
        .logo {
            margin-bottom: 20px;
        }
        .logo img {
            max-width: 200px;
        }
        .datetime {
            margin-bottom: 20px;
            font-size: 1.2em;
        }
        form {
            display: inline-block;
            text-align: left;
            margin-top: 20px;
        }
        label, select, button {
            display: block;
            margin: 10px 0;
            width: 100%;
        }
        button {
            background-color: #007bff; /* Blue color */
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #0056b3; /* Darker blue on hover */
        }
    </style>
</head>
<body>
    <div class="container">

        <h1><b><font color='blue'>ARCH AND ART ADVERTISING BOARDS LLC</font></b></h1></br>
        <h1 style="color: black; background-color: dark yellow;">Create Token</h1>
        @if (session('success'))
    <p style="color: green; font-weight: bold;">{{ session('success') }}</p>
    <audio id="tokenSound" src="{{ asset('alert.mp3') }}" preload="auto"></audio>
    <script>
                document.getElementById('tokenSound').play();
            </script>
@endif

        <form method="POST" action="{{ route('receptionist.store') }}">
            @csrf
            <label for="service">Select Service:</label>
            <select id="service" name="service">
                <option value="Acrylic">Acrylic</option>
                <option value="StainlessSteel">StainlessSteel</option>
                <option value="Emergency">Emergency</option>
            </select>
            <button type="submit" class="menu">Generate Token</button>
        </form>
        
    <div class="menu">
            <a href="{{ route('welcome') }}">Home</a>
            <!-- <a href="{{ route('receptionist.create') }}">Create Token</a> -->
            <a href="{{ route('cre.index') }}">View Tokens</a>
        </div>
        <div class="datetime" id="datetime"></div>
    </div>
    <script>
        function updateDateTime() {
            const now = new Date();
            const datetimeString = now.toLocaleString();
            document.getElementById('datetime').textContent = datetimeString;
        }

        // Update date and time every second
        setInterval(updateDateTime, 1000);
        updateDateTime(); // Initial call to display the date and time immediately
    </script>
    @vite('resources/js/app.js')
</body>
</html>
