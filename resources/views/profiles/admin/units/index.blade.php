@extends('adminlte::page')

@section('title', 'units')

@section('content_header')
    <h1>{!! trans('agave.units.index.header') !!}</h1>
@stop

@section('content')
    <div class="card">

        <div class="card-header">
            <a class="btn btn-primary btn-sm" href="{{route('units.create')}}">{!! trans('agave.actions.new') !!}</a>
        </div>
        <div class="card-body">
            @if($data->success)
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>{!! trans('agave.units.index.table.description') !!}</td>
                            <th colspan="2">{!! trans('agave.actions.actions') !!}</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data->units as $unit)
                            <tr>
                                <td>{{ $unit->description }}</td>
                                <td width="10px"> <a class="btn btn-primary btn-sm " href="">{!! trans('agave.actions.edit') !!}</a></td>
                                <td width="10px"> 
                                    <form class="form-prevent-multiple-submits" action="{{route('units.destroy',$unit->id)}}" method="POST" >
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-sm btn-prevent-multiple-submits">{!! trans('agave.actions.delete') !!}</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                
            @endif
        </div>
    </div>
@stop

@section('js')
    <script type="text/javascript" src="{{ URL::asset('js/prevent-multiple-submits.js') }}"></script>
@stop