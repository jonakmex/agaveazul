@extends('adminlte::page')

@section('title', 'Edit Asset')

@section('content_header')
  <h1>Edit Asset</h1>
@stop

@section('content')
<form action="{{ route('asset.update', $assetEditVm->id) }}" method="POST">
    @csrf
    @method('PUT')
    <input type="hidden" name="unitId" id="unitId" value="{{$assetEditVm->unitId}}">
    <div class="card">

        <div class="card-body">
           <div class="row">
                <x-adminlte-input name="description" label="Description" fgroup-class="col-md-6" value="{{$assetEditVm->description}}">
                </x-adminlte-input>
                <x-adminlte-select name="type" label="Type" fgroup-class="col-md-6">
                <option value="{{$assetEditVm->type['key']}}" hidden selected>
                    {{$assetEditVm->type['value']}}
                </option>
                    @foreach ($assetEditVm->types as $type)
                        <option value="{{$type['key']}}">{{$type['label']}}</option>
                    @endforeach
                </x-adminlte-select>
            </div>
        </div>
   
        <div class="card-footer">
            <a  href="{{route('asset.index',['unitId'=>$assetEditVm->unitId])}}">
                <x-adminlte-button label="Cancel"/>
            </a>
            <x-adminlte-button class="btn ml-2" type="submit" label="Edit" theme="primary"/>
        </div>

    </div>
</form>
@stop
