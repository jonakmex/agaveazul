@extends('adminlte::page')
@php
$heads = [
    'ID',
    'Name',
    'Last Name',  
    'Type',
    ['label' => 'Actions', 'no-export' => true, 'width'=> '20']
];

$config = [
    'columns' => [null, null, null, null, ['orderable' => false]],
    'paging' => false
];
@endphp

@section('title', 'Contacts')

@section('content_header')
  <h1>Unit {{$contactIndexVm->unit_id}}: Contacts</h1>
@stop

@section('content')

<div class="my-3">
    <a href="{{route('unit.show',$contactIndexVm->unit_id)}}">
        <x-adminlte-button label="View unit"/>
    </a>
    <a href="{{route('contact.create',['unit_id'=> $contactIndexVm->unit_id])}}" class="ml-2"> 
        <x-adminlte-button label="Add" theme="primary" icon="fa fa-plus-circle"/>
    </a>
</div>

<x-adminlte-datatable id="table2" :heads="$heads" :config="$config" head-theme="dark" striped bordered hoverable>
    @foreach($contactIndexVm->contactsVm as $row)
        <tr>
          @foreach($row as $cell)
             <td>{!! $cell !!}</td>
          @endforeach
        </tr>
    @endforeach
</x-adminlte-datatable>
<br>
<a href="{{route('unit.show', $contactIndexVm->unit_id)}}">
  <x-adminlte-button  theme="secondary" label="Back"/>
</a>

@stop