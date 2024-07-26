<!DOCTYPE html>
<html>
<head>
    <title>Token Queue</title>
</head>
<body>
    <h1>Token Queue</h1>
    <ul id="token-list">
        @foreach ($tokens as $token)
            <li>
                Token: {{ $token->token_number }} - Service: {{ $token->service }}
                <button onclick="callToken({{ $token->id }})">Call</button>
                <form method="POST" action="{{ route('cre.finish', $token->id) }}">
                    @csrf
                    <button type="submit">Finish</button>
                </form>
            </li>
        @endforeach
    </ul>

    <audio id="alert-sound" src="{{ asset('alert.mp3') }}" preload="auto"></audio>

    <script>
    function callToken(tokenId) {
        fetch(`/api/call-token/${tokenId}`, {
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
</script>
</body>
</html>
