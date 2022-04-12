@extends('adminlte::page')

@section('title', 'Unit')

@section('content_header')
    <h1>Units</h1>
@stop

@section('content')
<div>
    <a href="{{route('unit.create')}}">
        <x-adminlte-button label="Create Unit" theme="primary" />
    </a>
    <div>
        @livewire('unit-table-component')
    </div>
</div>
@stop

