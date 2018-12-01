@extends('_template.modal')

@section('modalbody')
<form action="{{route('residentes.generarToken',['id'=>$residente->id])}}" method="POST">
  {{ csrf_field () }}
  {{ method_field('POST') }}
  <div class="modal-header">
    <h4 class="modal-title">Token de Registro <b>{{$residente->nombre}}</b></h4>
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
  </div>
  <div class="modal-body">
    <p>¿Desea generar un token de registro para {{$residente->nombre}}?</p>
  </div>
  <div class="modal-footer">
    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
    <input type="submit" class="btn btn-danger" value="Generar">
  </div>
</form>
@overwrite
