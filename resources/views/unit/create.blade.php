@extends('adminlte::page')

@section('title', 'Create Asset')

@section('content_header')
  <h1>Create Unit</h1>
@stop

@section('content')
<form action="{{ route('unit.store') }}" method="POST">
    @csrf
    <div class="card">

        <div class="card-body">
           <div class="row" style="display: inline;">
                <x-adminlte-input name="description" label="Description" fgroup-class="col-md-6">
                </x-adminlte-input>
            </div>
            <x-adminlte-button class="btn ml-2" type="submit" label="Create" theme="success"/>
        </div>

    </div>
</form>
<a href="{{route('unit.index')}}">
  <x-adminlte-button  theme="secondary" label="Back"/>
</a>
@stop
