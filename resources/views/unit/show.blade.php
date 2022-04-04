<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Unit</title>
</head>
<body>
    <h1>Unit</h1>
    <ul>
    <li><b>Id: </b> {{$unit->id}}</li>
    <li><b>Description: </b> {{$unit->description}}</li>
    </ul>

    <br>

    <div>
        <form action="{{route('asset.create')}}">
            <input type="hidden" name="unitId" id="unitId" value="{{$unit->id}}">
            <input type="submit" value="Add asset" />
        </form> 
        
        <form action="{{route('asset.index')}}">
            <input type="hidden" name="unitId" id="unitId" value="{{$unit->id}}">
            <input type="submit" value="View assets"/>
        </form> 
    </div>
    <br>

    <form action="{{route('contact.index')}}">
        <input type="hidden" name="unit_id" value="{{$unit->id}}">
        <input type="submit" value="Contacts">
    </form>
    <form action="{{route('contact.create')}}">
        <input type="hidden" name="unit_id" value="{{$unit->id}}">
        <input type="submit" value="Add Contact">
    </form>
    
    <div>
        <a href="{{route('unit.index')}}">Back</a>
    </div>
</body>
</html>