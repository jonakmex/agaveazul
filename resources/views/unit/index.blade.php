@extends('adminlte::page')
@php
$heads = [
    'ID',
    'Description',
    ['label' => 'Actions', 'no-export' => true, 'width'=> '20']
];

$config = [
    'columns' => [null, null, ['orderable' => false]],
];
@endphp

@section('title', 'Unit')

@section('content_header')
    <h1>Units</h1>
@stop

@section('content')
<x-adminlte-datatable id="table1" :heads="$heads" :config="$config" head-theme="dark" striped bordered hoverable>
    @foreach($unitIndexVm->unitsVm as $row)
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

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css"> 
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop