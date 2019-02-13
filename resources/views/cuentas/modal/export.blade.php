@extends('_template.modal')

@section('modalbody')
<form action="{{route('estadoCta.exportar')}}" method="POST">
{{ csrf_field () }}
<div class="modal-header">
  <h4 class="modal-title">Seleccione periodo</b></h4>
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
</div>
<input type="hidden" name="id" value="{{$selected->id}}"/>
<div class="modal-body">

    <div class="form-group @php($err_fecInicio = $errors->has('fecInicio')?'has-error':'') {{$err_fecInicio}}" >
      <label for="fecInicio">Fecha Inicial</label>
      <div class="input-group date">
        <div class="input-group-addon">
          <i class="fa fa-calendar"></i>
        </div>
        <input type="text"  name="fecInicio" id="fecInicio" class="form-control"/ required>
      </div>
    </div>

    <div class="form-group @php($err_fecFin = $errors->has('fecFin')?'has-error':'') {{$err_fecFin}}" >
      <label for="fecFin">Fecha Final</label>
      <div class="input-group date">
        <div class="input-group-addon">
          <i class="fa fa-calendar"></i>
        </div>
        <input type="text"  name="fecFin" id="fecFin" class="form-control"/ required>
      </div>
    </div>
</div>
<div class="modal-footer">
  <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
  <button type="submit" class="btn btn-primary enviar" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Procesando...">Enviar</button>
</div>
</form>

@overwrite
