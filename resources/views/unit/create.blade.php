@extends('adminlte::page')

@section('title', 'Create Asset')

@section('content_header')
  <h1>Create Unit</h1>
@stop

@section('content')
@livewire('unit-form-create-component')

<a href="{{route('unit.index')}}">
  <x-adminlte-button  theme="secondary" label="Back"/>
</a>
@stop
