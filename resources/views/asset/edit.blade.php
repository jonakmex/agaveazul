<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
</head>
<body>
    <form action="{{route('asset.update',[$asset->id])}}" method="POST">
        @csrf 
        @method('PUT')
        <input value = "{{$asset->description}}" type="text" name="description">
        <input type="hidden" name="unitId" value="{{$asset->unitId}}">
        <select name="type" id="type">
            <option value="{{$asset->type}}" selected hidden>Select to change type</option>
            <option value="AUTOMOVIL">Automovil</option>
            <option value="TAG_ACCESO">Tag de acceso</option>
            <option value="REF_BANCO">Referencia de banco</option>
        </select>
        <button type="submit">edit</button>
    </form>

    <br>
    <div>
        <form action="{{route('asset.index')}}">
            <input type="hidden" name="unitId" value="{{$asset->unitId}}">
            <input type="submit" value="Back">
        </form>
    </div>
</body>
</html>