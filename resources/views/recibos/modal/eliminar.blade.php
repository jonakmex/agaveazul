@extends('_template.modal')

@section('modalbody')
<form action="{{route('recibos.eliminar',['rec_id'=>$recibo->id])}}" method="POST">
  {{ csrf_field () }}
  {{ method_field('POST') }}
  <div class="modal-header">
    <h4 class="modal-title">Eliminar Recibo</b></h4>
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
  </div>
  <div class="modal-body">
    <p>Confirma que desea eliminar el recibo ?</p>
    <p><b>{{$recibo->vivienda->descripcion}}</b></p>
    <p>{{$recibo->descripcion}} - ${{$recibo->saldo}}</p>
    <p class="text-warning"><small>Esta accion no puede deshacerse.</small></p>
  </div>
  <div class="modal-footer">
    <input type="button" class="btn btn-default" data-dismiss="modal" value="Volver">
    <button type="submit" class="btn btn-danger enviar" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Procesando...">Procesar</button>
  </div>
</form>
@overwrite
