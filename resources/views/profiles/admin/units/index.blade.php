@extends('adminlte::page')

@section('title', 'units')

@section('content_header')
    <h1>Units</h1>
@stop

@section('content')
    <div class="card">

        <div class="card-header">
            <a class="btn btn-primary btn-sm" href="{{route('units.create')}}">Nuevo</a>
        </div>

        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <td>Description</td>
                        <td colspan="2">Actions</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($units as $unit)
                        <tr>
                            <td>{{ $unit->description }}</td>
                            <td> <a class="btn btn-primary btn-sm" href="">Editar</a></td>
                            <td> <a class="btn btn-danger btn-sm" href="">Delete</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop