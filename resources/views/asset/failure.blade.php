<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>FAIL</h1>
    @foreach ($errors as $error)
        @foreach ($error as $err => $message)
            <p> {{$err}}: {{$message}}</p>
        @endforeach
    @endforeach
</body>
</html>