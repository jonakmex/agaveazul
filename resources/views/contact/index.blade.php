@extends('adminlte::page')


@section('title', 'Contacts')

@section('content_header')
  <h1>Unit {{$unit_id}}: Contacts</h1>
@stop

@section('content')

<div class="my-3">
    <a href="{{route('unit.show',$unit_id)}}">
        <x-adminlte-button label="View unit"/>
    </a>
    <a href="{{route('contact.create',['unit_id'=> $unit_id])}}" class="ml-2"> 
        <x-adminlte-button label="Add" theme="primary" icon="fa fa-plus-circle"/>
    </a>
</div>


@livewire('contact-table-component', ['unit_id'=> $unit_id])

<br>
<a href="{{route('unit.show', $unit_id)}}">
  <x-adminlte-button  theme="secondary" label="Back"/>
</a>

@stop
