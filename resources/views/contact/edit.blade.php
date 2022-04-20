@extends('adminlte::page')

@section('title', 'Edit Contact')

@section('content_header')
  <h1>Edit Contact</h1>
@stop

@section('content')

@livewire('contact-form-edit-component', [
    'contact' => [
        'id' => $contactEditVm->id, 
        'unit_id'=>$contactEditVm->unit_id, 
        'name' => $contactEditVm->name,
        'lastName' => $contactEditVm->lastName, 
        'type' => $contactEditVm->type,
        'typeKey' => $contactEditVm->typeKey
        
        ],
    'types'=> $contactEditVm->types
])

    <a  href="{{route('contact.index',['unit_id'=>$contactEditVm->unit_id])}}">
        <x-adminlte-button label="Cancel"/>
    </a>
@stop
