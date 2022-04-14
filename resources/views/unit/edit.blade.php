@extends('adminlte::page')

@section('title', 'Edit Asset')

@section('content_header')
  <h1>Edit Unit</h1>
@stop

@section('content')
@livewire('unit-form-edit-component', ['unitId' => $unitVm->id,'description' => $unitVm->description])

<a href="{{route('unit.index')}}">
  <x-adminlte-button  theme="secondary" label="Back"/>
</a>

@stop





