@extends('adminlte::page')

@section('title', 'units')

@section('content_header')
    <h1>{!! trans('agave.units.edit.header') !!}</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-body">
            
            {!! Form::model($unit,['route'=>['units.update',$unit],'method' => 'put','class' => 'form-prevent-multiple-submits']) !!}
            
                <div class="form-group">
                    
                    {!! Form::label('description', trans('agave.units.edit.form.description.label')) !!}
                    {!! Form::text('description', null, ['class'=>'form-control','placeholder'=>trans('agave.units.edit.form.description.placeholder')]) !!}
                </div>
                @error('description')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                
                {!! Form::submit(trans('agave.actions.save'), ['class'=>'btn btn-primary btn-prevent-multiple-submits']) !!}
                
            {!! Form::close() !!}
            
        </div>
    </div>
@stop

@section('js')
    <script type="text/javascript" src="{{ URL::asset('js/prevent-multiple-submits.js') }}"></script>
@stop