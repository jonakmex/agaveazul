@extends('adminlte::page')

@section('title', 'Create Contact')

@section('content_header')
  <h1>Create Contact</h1>
@stop

@section('content')
<form action="{{ route('contact.store') }}" method="POST">
    @csrf
    <input type="hidden" name="unit_id" id="unit_id" value="{{$contactCreateVm->unit_id}}">
    <div class="card">

        <div class="card-body">
           <div class="row">
                <x-adminlte-input name="name" label="Name" fgroup-class="col-md-6">
                </x-adminlte-input>
                <x-adminlte-input name="lastName" label="Last name" fgroup-class="col-md-6">
                </x-adminlte-input>
                <x-adminlte-select name="type" label="Type" fgroup-class="col-md-6">
                <option value="" hidden selected></option>
                    @foreach ($contactCreateVm->types as $type)
                        <option value="{{$type['key']}}">{{$type['label']}}</option>
                    @endforeach
                </x-adminlte-select>
            </div>
        </div>
   
        <div class="card-footer">
            <a  href="{{route('contact.index',['unit_id'=>$contactCreateVm->unit_id])}}">
                <x-adminlte-button label="Cancel"/>
            </a>
            <x-adminlte-button class="btn ml-2" type="submit" label="Create" theme="primary"/>
        </div>

    </div>
</form>
@stop