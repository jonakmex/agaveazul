@extends('_template.modal')

@section('modalbody')
<form action="{{route('documento.destroy',['id'=>$documento->id])}}" method="POST">
  {{ csrf_field () }}
  {{ method_field('DELETE') }}
  <div class="modal-header">
    <h4 class="modal-title">Eliminar <b>{{$documento->descripcion}}</b></h4>
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
  </div>
  <div class="modal-body">
    <p>Confirma que desea eliminar la {{$documento->descripcion}}?</p>
    <p class="text-warning"><small>Esta accion no puede deshacerse.</small></p>
  </div>
  <div class="modal-footer">
    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
    <input type="submit" class="btn btn-danger" value="Eliminar">
  </div>
</form>
@overwrite
