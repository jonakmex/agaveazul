@extends('adminlte::page')

@section('title', 'Edit Contact')

@section('content_header')
  <h1>Edit Contact</h1>
@stop

@section('content')
<form action="{{ route('contact.update', $contactEditVm->id) }}" method="POST">
    @csrf
    @method('PUT')
    <input type="hidden" name="unit_id" id="unit_id" value="{{$contactEditVm->unit_id}}">
    <div class="card">

        <div class="card-body">
           <div class="row">
                <x-adminlte-input name="name" label="Name" fgroup-class="col-md-6" value="{{$contactEditVm->name}}">
                </x-adminlte-input>
                <x-adminlte-input name="lastName" label="Last Name" fgroup-class="col-md-6" value="{{$contactEditVm->lastName}}">
                </x-adminlte-input>
                <x-adminlte-select name="type" label="Type" fgroup-class="col-md-6">
                <option value="{{$contactEditVm->type['key']}}" hidden selected>
                    {{$contactEditVm->type['value']}}
                </option>
                    @foreach ($contactEditVm->types as $type)
                        <option value="{{$type['key']}}">{{$type['label']}}</option>
                    @endforeach
                </x-adminlte-select>
            </div>
        </div>
   
        <div class="card-footer">
            <a  href="{{route('contact.index',['unit_id'=>$contactEditVm->unit_id])}}">
                <x-adminlte-button label="Cancel"/>
            </a>
            <x-adminlte-button class="btn ml-2" type="submit" label="Edit" theme="primary"/>
        </div>

    </div>
</form>
@stop
