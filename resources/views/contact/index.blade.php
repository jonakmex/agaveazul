<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Contacts</title>
  <style> 
   
  </style>
</head>

<body>
  <h1>All contacts</h1>

  <div>
    <form action="{{ route('contact.index') }}" style="display: inline;">
      <input type="text" placeholder="Name" name="name"/>
      <input type="text" placeholder="Last Name" name="lastName"/>
      <select name="type">
        <option  value="">Todos</option>
        <option  value="PROPIETARIO">Propietario</option>
        <option  value="ARRENDATARIO">Arrendatario</option>
        <option  value="REP_LEGAL">Rep. Legal</option>
      </select>
      <input type="hidden" name="unit_id" value="{{$unit_id}}">
      <input type="submit" value="Filter" />
    </form>
    <form action="{{ route('contact.index') }}" style="display: inline;">
        <input type="hidden" name="unit_id" value="{{$unit_id}}">
        <input type="submit" value="Clear" />
    </form>
  </div>

  <br><br>
  <table>
    <thead>
      <tr>
        <th>Name</th>
        <th>Type</th>
      </tr>
    </thead>
    <tbody>
      @forelse($contacts as $contact)
      <tr>
        <td><a href="{{route('contact.show',[$contact->id])}}">{{$contact->name}} {{$contact->lastName}}</a></td>
        <td>{{$contact->type}}</td>
        <td>
          <a href="{{route('contact.edit',[$contact->id])}}"><button>Edit</button></a>
          <form method="POST" action="{{route('contact.destroy',[$contact->id])}}" style="display: inline;">
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
  <div>
        <a href="{{route('unit.show', [$unit_id])}}">Back</a>
  </div>
  
</body>

</html>