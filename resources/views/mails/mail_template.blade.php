<!DOCTYPE html>
<html>
<head>
    <title>Donación</title>
    <style>
        body {
            color: red;
        }
    </style>
</head>
<body>
    <h1>Hola {{ $data['name'] }}!!</h1>
    <p>Gracias por realizar tu aportación, se ha cargado a tu cuenta $ {{ $data["total"] }}</p>
    <p>{{ $data["subscription"] }}</p>
    <p>{{ $data["dedication"] }}</p>
</body>
</html>