<!DOCTYPE html>
<html>
    <head>
        <title>Weather Information</title>
    </head>
    <body>
        @if(isset($error))
            <p>{{ $error }}</p>
        @else
            <h1>{{ $city }}の現在の天気</h1>
            <p>気温: {{ $temperature }}°C</p>
            <p>状態: {{ $condition }}</p>
        @endif
    </body>
</html>
