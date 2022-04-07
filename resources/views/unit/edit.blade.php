@extends('adminlte::page')

@section('title', 'Edit Asset')

@section('content_header')
  <h1>Edit Unit</h1>
@stop

@section('content')
<form action="{{ route('unit.update',$unitEditVm->unitsVm->id ) }}" method="POST">
    @csrf
    @method('PUT')
    <input type="hidden" name="id" id="id" value="{{$unitEditVm->unitsVm->id}}">
    <div class="card">
        <div class="card-body">
           <div class="row">
                <x-adminlte-input name="description" label="Description" fgroup-class="col-md-6" value="{{$unitEditVm->unitsVm->description}}">
                </x-adminlte-input>
           </div>
           
            <x-adminlte-button class="btn ml-2" type="submit" label="Edit" theme="primary"/>
        </div>
    </div>
</form>
<a href="{{route('unit.index')}}">
  <x-adminlte-button  theme="secondary" label="Back"/>
</a>

@stop





