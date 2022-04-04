<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <style> 
    td, th {
      padding: 0.5rem 1rem 0 0;
    }
  </style> 
</head>

<body>
  <h1>All units</h1>

  @if(session('success'))
  <div>{{ session("success") }}</div>
  @endif
  <div>
    <form id="filterForm" action="{{ route('unit.index') }}" style="display: inline;">
      @if ($errors->any())
      <p>{{$errors->description}}</p>
      @endif
      <input type="text" placeholder="Search" name="description" value="{{old('description')}}"/>
      <input type="submit" value="Filter" />
      <form action="{{ route('unit.index') }}" style="display: inline;">
        <input type="submit" value="Clear" />
      </form>
    </form>
  </div>
  <br><br>
  <table>
    <thead>
      <tr>
        <th>Description</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @forelse($units as $unit)
      <tr>
        <td><a href="{{route('unit.show',[$unit->id])}}">{{$unit->description}}</a></td>
        <td>
          <a href="{{route('unit.edit',[$unit->id])}}"><button>Edit</button></a>
          <form method="POST" action="{{route('unit.destroy',[$unit->id])}}" style="display: inline;">
            @csrf
            @method('delete')
            <input type="submit" value="Delete">
          </form>
        </td>
      </tr>
      @empty
      <p>There are no matches</p>
      @endforelse
    </tbody>
  </table>

  <br><br>

  <div>
    <a href="{{ route('unit.create') }}"><button>Add</button></a>
  </div>
</body>

</html>