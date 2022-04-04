<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contact</title>
</head>
<body>
    <h1>Contact</h1>
    <ul>
    <li><b>Id: </b> {{$contact->id}}</li>
    <li><b>Name: </b> {{$contact->name}}</li>
    <li><b>Last Name: </b> {{$contact->lastName}}</li>
    <li><b>Type: </b> {{$contact->type}}</li>
    <li><b>Unit Id: </b> {{$contact->unit_id}}</li>
    </ul>

    <br>
    <div>
        <form action="{{route('contact.index')}}">
            <input type="hidden" value="{{$contact->unit_id}}" name="unit_id">
            <input type="submit" value="Back">
        </form>
    </div>
</body>
</html>