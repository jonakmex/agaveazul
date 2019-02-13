@extends('_template.modal')

@section('modalbody')
<form action="{{ route('vivienda.store') }}" method="POST">
  {{ csrf_field () }}
	<div class="modal-header">
		<h4 class="modal-title">Crear Vivienda</h4>
		<a href="{{route('vivienda.index')}}" class="close" data-dismiss="modal" aria-hidden="true">&times;</a>
	</div>
	<div class="modal-body">
		<div class="form-group @php($err_descripcion = $errors->has('descripcion')?'has-error':'') {{$err_descripcion}}">
			<label for="descripcion">Descripcion</label>
			 <input type="text" value="{{ old('descripcion') }}" name="descripcion" id="descripcion" class="form-control"/ required>
       @if ($errors->has('descripcion'))
			 	<span class="help-block">{{ $errors->first('descripcion') }}</span>
			 @endif
		</div>
    <div class="form-group @php($err_referencia = $errors->has('referencia')?'has-error':'') {{$err_referencia}}">
			<label for="referencia">Referencia</label>
			 <input type="text" value="{{ old('referencia') }}" name="referencia" id="referencia" class="form-control"/ required>
       @if ($errors->has('referencia'))
			 	<span class="help-block">{{ $errors->first('referencia') }}</span>
			 @endif
		</div>
    <div class="form-group @php($err_clave = $errors->has('clave')?'has-error':'') {{$err_clave}}">
			<label for="clave">Clave</label>
			 <input type="text" value="{{ old('clave') }}" name="clave" id="clave" class="form-control"/ required>
       @if ($errors->has('clave'))
			 	<span class="help-block">{{ $errors->first('clave') }}</span>
			 @endif
		</div>
	</div>
	<div class="modal-footer">
    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
		<button type="submit" class="btn btn-success enviar" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Procesando...">Guardar</button>
	</div>
</form>

@overwrite
