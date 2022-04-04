<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contact</title>
</head>
<body>
    <form action="{{ route('contact.store') }}" method="POST">
        {{ csrf_field () }}
        <input type="hidden" name="unit_id" value="{{$unit_id}}"/>
        <label for="name">Name</label>
        <input type="text" name="name" id="name"/>
        <label for="lastName">Last Name</label>
        <input type="text" name="lastName" id="lastName"/>

        <p>Type:<br>
        <input type="radio" name="type" value="PROPIETARIO"> Propietario<br>
        <input type="radio" name="type" value="ARRENDATARIO"> Arrendatario<br>
        <input type="radio" name="type" value="REP_LEGAL"> Rep. Legal
        </p>

        <button type="submit">Guardar</button>
    </form>

    <div>
        <a href="{{route('unit.show', [$unit_id])}}">Back</a>
  </div>

</body>
</html>