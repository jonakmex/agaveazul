@extends('adminlte::page')

@section('title', 'Unit')

@section('content_header')
    <h1> Unit </h1>
@stop

@section('content')

<div class="card">
  <div class="card-header">
    <h3 class="card-title">{{$unitShowVm->unitsVm->description}}</h3>
  </div>
  <div class="my-3" style="display: flex; align-items:center; gap:20px;">
    <a style="margin-left: 15px;" href="{{route('contact.index', ['unit_id'=> $unitShowVm->unitsVm->id])}}">
      <x-adminlte-button theme="primary" label="Contacts"/>
    </a>
    <a href="{{route('asset.index', ['unitId'=> $unitShowVm->unitsVm->id])}}">
      <x-adminlte-button  theme="success" label="Assets"/>
    </a> 
  </div>   
</div>
<a href="{{route('unit.index')}}">
  <x-adminlte-button  theme="secondary" label="Back"/>
</a>
@stop



