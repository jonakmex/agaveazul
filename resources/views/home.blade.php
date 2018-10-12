@extends('_template.logged')

@section('title')
  <title>Home</title>
@endsection

@section('styles')
  <link href="{{asset('css/starter-template.css')}}" rel="stylesheet">
  <link href="{{asset('css/custom-checkbox.css')}}" rel="stylesheet">
  <link href="{{asset('css/custom-table.css')}}" rel="stylesheet">
  <link href="{{asset('css/custom-modal.css')}}" rel="stylesheet">
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
      <th>Name</th>
      <th>Email</th>
      <th>Address</th>
      <th>Phone</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>
        <span class="custom-checkbox">
        <input type="checkbox" id="checkbox1" name="options[]" value="1">
        <label for="checkbox1"></label>
        </span>
      </td>
      <td>Thomas Hardy</td>
      <td>thomashardy@mail.com</td>
      <td>89 Chiaroscuro Rd, Portland, USA</td>
      <td>(171) 555-2222</td>
      <td>
        <a href="#editEmployeeModal" class="edit" data-toggle="modal"><ion-icon  name="create" data-toggle="tooltip" title="Edit"></i></a>
        <a href="#deleteEmployeeModal" class="delete" data-toggle="modal"><ion-icon name="trash" data-toggle="tooltip" title="Delete"></i></a>
      </td>
    </tr>
  </tbody>
</table>

@include('_template.home.modal.edit',['name'=>'editEmployeeModal'])
@include('_template.home.modal.add',['name'=>'addEmployeeModal'])
@include('_template.home.modal.delete',['name'=>'deleteEmployeeModal'])
@endsection
@section('scripts')
<script src="{{asset('js/home.js')}}"></script>
@endsection
