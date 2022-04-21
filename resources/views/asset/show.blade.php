@extends('adminlte::page')

@section('title', 'Asset')

@section('content_header')
  <h1>Asset {{$assetShowVm->id}}</h1>
@stop

@section('content')
    @livewire('asset-show-component', [
        'assetId' => $assetShowVm->id,
        'unitId' => $assetShowVm->unitId,
        'description' => $assetShowVm->description,
        'type' => $assetShowVm->type,
    ])
@stop