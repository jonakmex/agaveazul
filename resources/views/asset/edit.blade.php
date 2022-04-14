@extends('adminlte::page')

@section('title', 'Edit Asset')

@section('content_header')
  <h1>Edit Asset</h1>
@stop

@section('content')
@livewire('asset-form-edit-component', [
    'asset' => [
        'id' => $assetEditVm->id, 
        'unitId'=>$assetEditVm->unitId, 
        'description' => $assetEditVm->description, 
        'type' => $assetEditVm->type,
        'typeKey' => $assetEditVm->typeKey
        ],
    'types'=> $assetEditVm->types
])
@stop
