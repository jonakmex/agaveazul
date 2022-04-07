@extends('adminlte::page')

@section('title', 'Asset')

@section('content_header')
  <h1>Asset {{$assetShowVm->id}}</h1>
@stop

@section('content')

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col">
                <p><b>Id</b></p>
                <p><b>Unit id</b></p>
                <p><b>Description</b></p>
                <p><b>Type</b></p>
            </div>
            <div class="col">
                <p>{{$assetShowVm->id}}</p>
                <p>{{$assetShowVm->unitId}}</p>
                <p>{{$assetShowVm->description}}</p>
                <p>{{$assetShowVm->type}}</p>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <a href="{{route('asset.index',['unitId'=>$assetShowVm->unitId])}}">
            <x-adminlte-button label="Back"/>
        </a>
        <a href="{{route('asset.edit',$assetShowVm->id)}}" class="ml-2"> 
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