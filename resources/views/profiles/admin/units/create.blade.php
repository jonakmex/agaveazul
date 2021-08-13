@extends('adminlte::page')

@section('title', 'units')

@section('content_header')
    <h1>Crear Unidad </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            
            {!! Form::open(['route'=>'units.store']) !!}

                <div class="form-group">
                    {!! Form::label('description', 'Description') !!}
                    {!! Form::text('description', null, ['class'=>'form-control','placeholder'=>'Descripcion']) !!}
                </div>
                @error('description')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                
                {!! Form::submit('Crear', ['class'=>'btn btn-primary']) !!}
                
            {!! Form::close() !!}
            
        </div>
    </div>
@stop