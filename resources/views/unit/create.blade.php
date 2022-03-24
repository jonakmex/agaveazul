<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{ route('unit.store') }}" method="POST">
        {{ csrf_field () }}
        <label for="descripcion">Descripcion</label>
        <input type="textfield" name="description" id="description"/>
        <button type="submit">Guardar</button>
    </form>
</body>
</html>