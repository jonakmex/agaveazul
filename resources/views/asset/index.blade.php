<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
</head>

<body>
  <h1>Unit {{$unitId}} Assets</h1>

  <div>
    <form action="{{ route('asset.index') }}" style="display: inline;">
      <input type="text" placeholder="Description..." name="description"/>
      <label for="type">Type</label>
      <select name="type" id="type">
        <option selected hidden value=""></option>
        <option value="AUTOMOVIL">Automovil</option>
        <option value="REF_BANCO">Referencia banco</option>
        <option value="TAG_ACCESO">Tag de acceso</option>
      </select>
      <input type="hidden" name="unitId" value="{{$unitId}}"/>
      <input type="submit" value="Filter" />
    </form>
    <form action="{{ route('asset.index') }}" style="display: inline;">
      <input type="hidden" name="unitId" value="{{$unitId}}"/>
      <input type="submit" value="clear"/>
    </form>
  </div>
  <br><br>
  <table>
    <thead>
      <tr>
        <th>Unit</th>
        <th>Type</th>
        <th>Description</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @forelse($assets as $asset)
      <tr>
        <td>{{$asset->unitId}}</td>
        <td>{{$asset->type}}</td>
        <td><a href="{{route('asset.show',[$asset->id])}}">{{$asset->description}}</a></td>
        <td>
          <a href="{{route('asset.edit',[$asset->id])}}"><button>Edit</button></a>
          <form method="POST" action="{{route('asset.destroy',[$asset->id])}}" style="display: inline;">
            @csrf
            @method('delete')
            <input type="submit" value="Delete">
          </form>
        </td>
      </tr>
      @empty
      <p>Empty</p>
      @endforelse
    </tbody>
  </table>

  <br><br>
  <div>
    <a href="{{route('unit.show',[$unitId])}}">Back</a>
  </div>
</body>

</html>