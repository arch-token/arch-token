<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Token Queue</title>
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
            max-width: 1000px;
            margin: 0 auto;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        button {
            padding: 10px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
    <h1><b><font color='blue'>ARCH AND ART ADVERTISING BOARDS LLC</font></b></h1></br>
        <h1>Token Queue</h1>

        <!-- Acrylic Service Tokens -->
        <h2><font color='red'>Acrylic Service</font></h2>
        <table>
            <thead>
                <tr>
                    <th>Token Number</th>
                    <th>Service</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tokens->where('service', 'Acrylic') as $token)
                    <tr>
                        <td>{{ $token->token_number }}</td>
                        <td>{{ $token->service }}</td>
                        <td>
                            <button onclick="callToken({{ $token->id }})">Call</button>
                            <form method="POST" action="{{ route('cre.finish', $token->id) }}" style="display:inline;">
                                @csrf
                                <button type="submit">Finish</button>
                            </form>
                            <button onclick="printToken({{ $token->id }})">Print</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Stainless Steel Service Tokens -->
        <h2><font color='red'>Stainless Steel Service</font></h2>
        <table>
            <thead>
                <tr>
                    <th>Token Number</th>
                    <th>Service</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tokens->where('service', 'StainlessSteel') as $token)
                    <tr>
                        <td>{{ $token->token_number }}</td>
                        <td>{{ $token->service }}</td>
                        <td>
                            <button onclick="callToken({{ $token->id }})">Call</button>
                            <form method="POST" action="{{ route('cre.finish', $token->id) }}" style="display:inline;">
                                @csrf
                                <button type="submit">Finish</button>
                            </form>
                            <button onclick="printToken({{ $token->id }})">Print</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Emergency Service Tokens -->
        <h2><font color='red'>Emergency Service</font></h2>
        <table>
            <thead>
                <tr>
                    <th>Token Number</th>
                    <th>Service</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tokens->where('service', 'Emergency') as $token)
                    <tr>
                        <td>{{ $token->token_number }}</td>
                        <td>{{ $token->service }}</td>
                        <td>
                            <button onclick="callToken({{ $token->id }})">Call</button>
                            <form method="POST" action="{{ route('cre.finish', $token->id) }}" style="display:inline;">
                                @csrf
                                <button type="submit">Finish</button>
                            </form>
                            <button onclick="printToken({{ $token->id }})">Print</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Include the audio file -->
        <audio id="alert-sound" src="{{ asset('alert.mp3') }}" preload="auto"></audio>

        <script>
            function callToken(tokenId) {
                fetch(`/cre/call/${tokenId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    document.getElementById('alert-sound').play();

                    // Wait for the audio to finish before speaking the token
                    document.getElementById('alert-sound').onended = function() {
                        speakToken(data.token.token_number);
                    };

                    alert(`Token ${data.token.token_number} called`);
                });
            }
            

            function speakToken(token) {
                const voices = window.speechSynthesis.getVoices();

                // English voice
                const msgEn = new SpeechSynthesisUtterance();
                msgEn.text = `Token number ${token} is now being called`;
                msgEn.lang = 'en-US';
                const femaleVoice = voices.find(voice => voice.name.includes('Female') || voice.gender === 'female' || voice.name.includes('Google UK English Female'));
                if (femaleVoice) {
                    msgEn.voice = femaleVoice;
                } else {
                    msgEn.voice = voices.find(voice => voice.lang === 'en-US');
                }

                // Arabic voice
                const msgAr = new SpeechSynthesisUtterance();
                msgAr.text = `رقم التذكرة ${token} يتم استدعاؤه الآن`;
                msgAr.lang = 'ar-SA';
                const arabicVoice = voices.find(voice => voice.lang === 'ar-SA' || voice.lang.startsWith('ar'));
                if (arabicVoice) {
                    msgAr.voice = arabicVoice;
                }

                // Debugging output
                console.log('English Voice:', msgEn.voice);
                console.log('Arabic Voice:', msgAr.voice);

                // Speak English first, then Arabic
                window.speechSynthesis.speak(msgEn);
                msgEn.onend = () => {
                    window.speechSynthesis.speak(msgAr);
                };
            }
            function printToken(tokenId) {
                window.location.href = `/receptionist/print/${tokenId}`;
            }

            // Ensure voices are loaded
            window.speechSynthesis.onvoiceschanged = function() {
                if (speechSynthesis.onvoiceschanged !== undefined) {
                    speechSynthesis.onvoiceschanged = null;
                    const voices = speechSynthesis.getVoices();
                    if (voices.length > 0) {
                        console.log('Voices loaded:', voices);
                    }
                }
            };
        </script>
        
        @vite('resources/js/app.js')
    </div>
</body>
</html>
