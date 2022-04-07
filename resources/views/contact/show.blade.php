@extends('adminlte::page')

@section('title', 'Asset')

@section('content_header')
  <h1>Asset {{$contactShowVm->id}}</h1>
@stop

@section('content')

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col">
                <p><b>Id</b></p>
                <p><b>Unit id</b></p>
                <p><b>Name</b></p>
                <p><b>Last Name</b></p>
                <p><b>Type</b></p>
            </div>
            <div class="col">
                <p>{{$contactShowVm->id}}</p>
                <p>{{$contactShowVm->unit_id}}</p>
                <p>{{$contactShowVm->name}}</p>
                <p>{{$contactShowVm->lastName}}</p>
                <p>{{$contactShowVm->type}}</p>
            </div>
        </div>
    </div>
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