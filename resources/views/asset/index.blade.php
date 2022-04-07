@extends('adminlte::page')
@php
$heads = [
    'ID',
    'Description',  
    'Type',
    ['label' => 'Actions', 'no-export' => true, 'width'=> '20']
];

$config = [
    'columns' => [null, null, null, ['orderable' => false]],
    'paging' => false
];
@endphp

@section('title', 'Assets')

@section('content_header')
  <h1>Unit {{$assetIndexVm->unitId}} Assets</h1>
@stop

@section('content')

<div class="my-3">
    <a href="{{route('unit.show',$assetIndexVm->unitId)}}">
        <x-adminlte-button label="View unit"/>
    </a>
    <a href="{{route('asset.create',['unitId'=> $assetIndexVm->unitId])}}" class="ml-2"> 
        <x-adminlte-button label="Add" theme="success" icon="fa fa-plus-circle"/>
    </a>
</div>

<x-adminlte-datatable id="table1" :heads="$heads" :config="$config" head-theme="dark" striped bordered hoverable>
    @foreach($assetIndexVm->assetsVm as $row)
        <tr>
          @foreach($row as $cell)
             <td>{!! $cell !!}</td>
          @endforeach
        </tr>
    @endforeach
</x-adminlte-datatable>

<br>
<br>
<br>
@stop