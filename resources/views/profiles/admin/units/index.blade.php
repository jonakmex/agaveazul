@extends('adminlte::page')

@section('title', 'units')

@section('content_header')
    <h1>{!! trans('agave.units.create.header') !!}</h1>
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
                        <th>Description</td>
                        <th colspan="2">Acciones</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($units as $unit)
                        <tr>
                            <td>{{ $unit->description }}</td>
                            <td width="10px"> <a class="btn btn-primary btn-sm" href="">Editar</a></td>
                            <td width="10px"> 
                                <form action="{{route('units.destroy',$unit->id)}}" method="POST" >
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop