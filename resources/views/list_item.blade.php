<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Studio</title>
</head>
<body>
<div>
    <h1>List Studio</h1>
    @foreach($item as $studio)
        <p>Kode Studio: {{ $studio['id'] }}</p>
        <p>Tipe Studio: {{ $studio['tipe'] }}</p>
        <p>Harga Studio: {{ $studio['harga'] }}</p>
        <p>Status Studio: {{ $studio['status'] }}</p>
        <hr>
    @endforeach
</div>
</body>
</html>