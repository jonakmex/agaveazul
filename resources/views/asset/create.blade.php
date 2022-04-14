@extends('adminlte::page')

@section('title', 'Create Asset')

@section('content_header')
  <h1>Create Asset</h1>
@stop

@section('content')
@livewire('asset-form-create-component', [
    'unitId' => $assetCreateVm->unitId,
    'types' => $assetCreateVm->types
])
@stop
