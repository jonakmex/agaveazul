@extends('adminlte::page')

@section('title', 'units')

@section('content_header')
    <h1>{!! trans('agave.units.create.header') !!}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            
            {!! Form::open(['route'=>'units.store']) !!}

                <div class="form-group">
                    {!! Form::label('description', trans('agave.units.create.form.description.label')) !!}
                    {!! Form::text('description', null, ['class'=>'form-control','placeholder'=>trans('agave.units.create.form.description.placeholder')]) !!}
                </div>
                @error('description')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                
                {!! Form::submit(trans('agave.actions.save'), ['class'=>'btn btn-primary']) !!}
                
            {!! Form::close() !!}
            
        </div>
    </div>
@stop