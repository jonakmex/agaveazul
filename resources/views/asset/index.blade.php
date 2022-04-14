@extends('adminlte::page')


@section('title', 'Assets')

@section('content_header')
  <h1>Assets</h1>
@stop

@section('content')

<div class="my-3">
    <a href="{{route('unit.show',$unitId)}}">
        <x-adminlte-button label="View unit"/>
    </a>
    <a href="{{route('asset.create',['unitId'=> $unitId])}}" class="ml-2"> 
        <x-adminlte-button label="Add" theme="success" icon="fa fa-plus-circle"/>
    </a>
</div>

@livewire('asset-table-component', ['unitId'=>$unitId])

<br>
<br>
<br>
@stop