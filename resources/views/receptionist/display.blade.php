<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Reception Display</title>
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
        .token-display {
           /* font-size: 3em;
            margin: 20px 0;*/
            font-size: 50px; /* Big size */
            color: red; /* Red color */
            font-weight: bold;
        }
      
    </style>
</head>
<body>


    <h1> <b><font color='blue' ;>ARCH AND ART ADVERTISING BOARDS LLC </font><b> </h1></br>

    <div class="container">
        <h1>Currently Calling</h1>
        <div id="token-display" class="token-display">No token is being called</div>
    </div>
    <script>
        function fetchCurrentToken() {
            fetch('/api/current-token')
                .then(response => response.json())
                .then(data => {
                    console.log('Current token data:', data); // Debugging line
                    if (data.token) {
                        document.getElementById('token-display').textContent = `Token ${data.token.token_number}`;
                    } else {
                        document.getElementById('token-display').textContent = 'No token is being called';
                    }
                })
                .catch(error => {
                    console.error('Error fetching current token:', error);
                });
        }

        // Poll for updates every 5 seconds
        setInterval(fetchCurrentToken, 5000);
        fetchCurrentToken(); // Initial call
    </script>
    @vite('resources/js/app.js')
</body>
</html>
