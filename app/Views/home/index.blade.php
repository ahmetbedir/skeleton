<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home Page</title>
</head>
<body>
    <h1>Anasayfa</h1>
    <p>
        <ul>
            @foreach ($examples as $example)
                <li>{{ $example }}</li>
            @endforeach
        </ul>
    </p>
</body>
</html>