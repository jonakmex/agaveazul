@extends('adminlte::page')

@section('title', 'Create Asset')

@section('content_header')
  <h1>Create Asset</h1>
@stop

@section('content')
<form action="{{ route('asset.store') }}" method="POST">
    @csrf
    <input type="hidden" name="unitId" id="unitId" value="{{$assetCreateVm->unitId}}">
    <div class="card">

        <div class="card-body">
           <div class="row">
                <x-adminlte-input name="description" label="Description" fgroup-class="col-md-6">
                </x-adminlte-input>
                <x-adminlte-select name="type" label="Type" fgroup-class="col-md-6">
                <option value="" hidden selected></option>
                    @foreach ($assetCreateVm->types as $type)
                        <option value="{{$type['key']}}">{{$type['label']}}</option>
                    @endforeach
                </x-adminlte-select>
            </div>
        </div>
   
        <div class="card-footer">
            <a  href="{{route('asset.index',['unitId'=>$assetCreateVm->unitId])}}">
                <x-adminlte-button label="Cancel"/>
            </a>
            <x-adminlte-button class="btn ml-2" type="submit" label="Create" theme="success"/>
        </div>

    </div>
</form>
@stop
