<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Token</title>
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            text-align: center;
            padding: 50px;
        }
        .token {
            border: 1px solid #333;
            padding: 20px;
            margin: 20px auto;
            width: 300px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .print-button {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .print-button:hover {
            background: #0056b3;
        }
        @media print {
            .print-button {
                display: none;
            }
        }
    </style>
</head>
<body>
    
 
    <div class="token">
   <h5> <b><font color='blue' ;>ARCH AND ART ADVERTISING BOARDS LLC </font><b> </h5></br>
        <h2>Token</h2>
        <p>Token Number: {{ $token->token_number }}</p>
        <p>Service: {{ $token->service }}</p>
        <p>Date: {{ $token->created_at->format('Y-m-d') }}</p>
        <p>Time: {{ $token->created_at->format('H:i:s') }}</p>
        
    </div>
    <button class="print-button" onclick="window.print()">Print</button>
</body>
</html>
