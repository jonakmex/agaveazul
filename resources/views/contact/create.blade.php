@extends('adminlte::page')

@section('title', 'Create Contact')

@section('content_header')
  <h1>Create Contact</h1>
@stop

@section('content')

    @livewire('contact-form-create-component',['unit_id'=> $unit_id])
    <a  href="{{route('contact.index',['unit_id'=>$unit_id])}}">
        <x-adminlte-button label="Cancel"/>
    </a>
@stop
