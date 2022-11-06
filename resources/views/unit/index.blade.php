@extends('adminlte::page')

@section('title', 'Unit')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>Units</h1>
        <a href="{{route('unit.create')}}">
            <x-adminlte-button label="Create Unit" theme="primary" />
        </a>
    </div>
@stop

@section('content')
    @livewire('unit-table-component')
@stop

