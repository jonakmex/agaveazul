<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Asset</title>
</head>
<body>
    <h1>Asset</h1>
    <ul>
    <li><b>Id: </b> {{$asset->id}}</li>
    <li><b>Unit Id: </b> {{$asset->unitId}}</li>
    <li><b>Type: </b> {{$asset->type}}</li>
    <li><b>Description: </b> {{$asset->description}}</li>
    </ul>

    <br>
    <div>
        <form action="{{route('asset.index')}}">
            <input type="hidden" name="unitId" value="{{$asset->unitId}}">
            <input type="submit" value="Back">
        </form>
    </div>
</body>
</html>