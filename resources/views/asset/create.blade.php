<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{ route('asset.store') }}" method="POST">
        @csrf
        <input type="hidden" name="unitId" id="unitId" value="{{$unitId}}">
        <label for="description">Description</label>
        <input type="text" name="description" id="description"/>
        <label for="type">Type</label>
        <select name="type" id="type">
            <option hidden selected></option>
            <option value="AUTOMOVIL">Automovil</option>
            <option value="TAG_ACCESO">Tag de acceso</option>
            <option value="REF_BANCO">Referencia de banco</option>
        </select>
        <button type="submit">Add</button>
    </form>

    <br>
    <div>
        <a href="{{route('unit.show',[$unitId])}}">Back</a>
    </div>
</body>
</html>