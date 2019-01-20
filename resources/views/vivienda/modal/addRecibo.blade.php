@extends('_template.modal')

@section('modalbody')
<form action="{{route('vivienda.generarRecibo')}}" method="POST">
  {{ csrf_field () }}
  <input type="hidden" value="{{$vivienda->id}}" name="vivienda_id">
	<div class="modal-header">
		<h4 class="modal-title">Generar Recibo {{$vivienda->descripcion}}</h4>
		<a href="" class="close" data-dismiss="modal" aria-hidden="true">&times;</a>
	</div>
	<div class="modal-body">
    <div class="form-group">
      <label for="cuenta_id">Cuota</label>
      <select class="form-control select2" id="cuota_id" name="cuota_id">
        @foreach($vivienda->cuotas as $cuotaVivienda)
          <option value="{{$cuotaVivienda->cuota->id}}">{{$cuotaVivienda->cuota->descripcion}}</option>
        @endforeach
      </select>
       @if ($errors->has('cuota'))
           <div class="error">{{ $errors->first('cuota') }}</div>
       @endif
    </div>
	</div>
	<div class="modal-footer">
    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
		<input type="submit" class="btn btn-success" value="Generar">
	</div>
</form>

@overwrite
