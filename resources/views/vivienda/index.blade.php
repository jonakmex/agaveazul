@extends('_template.logged')

@section('title')
  <title>Home</title>
@endsection

@section('styles')
  <link href="{{asset('css/starter-template.css')}}" rel="stylesheet">
  <link href="{{asset('css/custom-checkbox.css')}}" rel="stylesheet">
  <link href="{{asset('css/custom-table.css')}}" rel="stylesheet">
  <link href="{{asset('css/custom-modal.css')}}" rel="stylesheet">
  <link href="{{asset('css/custom-pagination.css')}}" rel="stylesheet">
@endsection

@section('main')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
<h1 class="h2">Viviendas</h1>
<div class="btn-toolbar mb-2 mb-md-0">
  <div class="btn-group mr-2">
    <button data-target="#addEmployeeModal" data-toggle="modal" class="btn btn-sm btn-outline-primary"><ion-icon name="add"></ion-icon>Nuevo</button>
    <button data-target="#deleteEmployeeModal" data-toggle="modal" class="btn btn-sm btn-outline-secondary"><ion-icon name="trash"></ion-icon>Eliminar</button>
  </div>
</div>
</div>

<table class="table table-striped table-hover">
  <thead>
    <tr>
      <th>
        <span class="custom-checkbox">
          <input type="checkbox" id="selectAll">
          <label for="selectAll"></label>
        </span>
      </th>
      <th>Descripcion</th>
      <th>Acciones</th>
    </tr>
  </thead>
  <tbody>
    @foreach($viviendas as $vivienda)
    <tr>
      <td>
        <span class="custom-checkbox">
        <input type="checkbox" id="checkbox1" name="options[]" value="1">
        <label for="checkbox1"></label>
        </span>
      </td>
      <td>{{ $vivienda->descripcion }}</td>
      <td>
        <a href="#editEmployeeModal{{$vivienda->id}}" class="edit" data-toggle="modal"><ion-icon  name="create" data-toggle="tooltip" title="Edit"></i></a>
        <a href="#deleteEmployeeModal{{$vivienda->id}}" class="delete" data-toggle="modal"><ion-icon name="trash" data-toggle="tooltip" title="Delete"></i></a>
      </td>
    </tr>
    @include('vivienda.modal.edit',['name'=>'editEmployeeModal'.$vivienda->id])
    @include('vivienda.modal.delete',['name'=>'deleteEmployeeModal'.$vivienda->id])
    @endforeach
  </tbody>
</table>
<div class="clearfix">
{{ $viviendas->links('_template.paginator', ['results' => $viviendas]) }}
</div>

@include('vivienda.modal.add',['name'=>'addEmployeeModal'])

@endsection
@section('scripts')
<script src="{{asset('js/home.js')}}"></script>
@endsection
