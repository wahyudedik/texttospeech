<!DOCTYPE html>
<html>
<head>
    <title>Text-to-Speech</title>
</head>
<body>
    <h1>Text-to-Speech</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form method="post" action="/speech">
        @csrf
        <div>
            <label for="text">Teks:</label>
            <input type="text" id="text" name="text">
        </div>
        <button type="submit">Convert to Speech</button>
    </form>

    <h2>Daftar Speech</h2>
    <ul>
        @foreach ($speeches as $speech)
            <li>
                <p>{{ $speech->text }}</p>
                @if ($speech->audio_file)
                    <audio controls>
                        <source src="{{ asset('storage/' . $speech->audio_file) }}" type="audio/mpeg">
                        Your browser does not support the audio element.
                    </audio>
                @endif
            </li>
        @endforeach
    </ul>
</body>
</html>
