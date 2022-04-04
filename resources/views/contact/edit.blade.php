<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
</head>
<body>
    <form action="{{route('contact.update',[$contact->id])}}" method="POST">
        @csrf
        @method('PUT')
        <input value = "{{$contact->name}} "type="text" name="name">
        <input value = "{{$contact->lastName}} "type="text" name="lastName">
        <p>Type:<br>
        <input type="radio" name="type" value="PROPIETARIO"> Propietario<br>
        <input type="radio" name="type" value="ARRENDATARIO"> Arrendatario<br>
        <input type="radio" name="type" value="REP_LEGAL"> Rep. Legal
        </p>
        <button type="submit">editar</button>
    </form>

    <br>
    
</body>
</html>