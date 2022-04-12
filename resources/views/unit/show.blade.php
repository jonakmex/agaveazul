@extends('adminlte::page')

@section('title', 'Unit')

@section('content_header')
    <h1> Unit </h1>
@stop

@section('content')

@livewire('unit-show-component',[
    'unit' => ['id' => $unitVm->id, 'description' => $unitVm->description]
])

<a href="{{route('unit.index')}}">
  <x-adminlte-button  theme="secondary" label="Back"/>
</a>

@stop



