@extends('_template.modal')

@section('modalbody')
<form action="{{route('movimientos.destroy',['id'=>$movimiento->id])}}" method="POST">
  {{ csrf_field () }}
  {{ method_field('DELETE') }}
  <div class="modal-header">
    <h4 class="modal-title">Eliminar <b>{{$movimiento->descripcion}}</b></h4>
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
  </div>
  <div class="modal-body">
    <p>Confirma que desea eliminar la {{$movimiento->descripcion}}?</p>
    <p class="text-warning"><small>Esta accion no puede deshacerse.</small></p>
  </div>
  <div class="modal-footer">
    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
    <button type="submit" class="btn btn-danger enviar" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Procesando..." >Eliminar</button>
  </div>
</form>
@overwrite
