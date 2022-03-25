<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
</head>
<body>
    <form action="{{route('unit.update',[$unit->getId()])}}" method="PUT">
        @csrf
        @method('PUT')
        <input value = "{{$unit->getDescription()}} "type="text" name="description">
        <button type="submit">editar</button>
    </form>
</body>
</html>