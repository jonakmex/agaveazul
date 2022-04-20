@extends('adminlte::page')

@section('title', 'Asset')

@section('content_header')
  <h1>Asset {{$contactShowVm->id}}</h1>
@stop

@section('content')
  @livewire('contact-show-component',['contact' => [
    'id' => $contactShowVm->id, 
    'name' => $contactShowVm->name,
    'lastName' => $contactShowVm->lastName,
    'type' => $contactShowVm->type,
    'unit_id' => $contactShowVm->unit_id]] )

<div class="card">
    
    <div class="card-footer">
        <a href="{{route('contact.index',['unit_id'=>$contactShowVm->unit_id])}}">
            <x-adminlte-button label="Back"/>
        </a>
        <a href="{{route('contact.edit',$contactShowVm->id)}}" class="ml-2"> 
            <x-adminlte-button label="Edit" theme="primary"/>
        </a>
    </div>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css"> 
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
