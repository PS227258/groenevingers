<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Postcode Lookup</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Postcode Opzoeken</h1>
        <form action="{{ route('postcode.lookup') }}" method="POST">
            @csrf
            @method('POST')
            <div class="form-group">
                <label for="postcode">Postcode:</label>
                <input type="text" id="postcode" name="postcode" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="house_number">Huisnummer:</label>
                <input type="text" id="house_number" name="house_number" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Zoek op</button>
            <a href="{{ route('homepage.index') }}" class="btn btn-danger">Terug</a>
        </form>

        @isset($result)
            @if(is_array($result))
                <div class="mt-4">
                    <h2>Postcode opzoek resultaat:</h2>
                    <p><strong>Stad/Dorp:</strong> {{ $result['city'] }}</p>
                    <p><strong>Straat:</strong> {{ $result['street'] }}</p>
                    <p><strong>Provincie:</strong> {{ $result['province'] }}</p>
                    <p><strong>Postcode:</strong> {{ $result['postcode'] }}</p>
                    <p><strong>Huisnummer:</strong> {{ $result['house_number'] }}</p>
                    <p><strong>Latitude:</strong> {{ $result['latitude'] }}</p>
                    <p><strong>Longitude:</strong> {{ $result['longitude'] }}</p>
                </div>
            @else
                <div class="mt-4">
                    <h2>Postcode opzoek resultaat:</h2>
                    <p>{{ $result }}</p>
                </div>
            @endif
        @endisset
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
