@extends('_template.modal')

@section('modalbody')
<form action="{{route('cuentas.store')}}" method="POST">
    {{ csrf_field () }}
	<div class="modal-header">
		<h4 class="modal-title">Crear Cuenta</h4>
		<a href="{{route('cuentas.index')}}" class="close" data-dismiss="modal" aria-hidden="true">&times;</a>
	</div>
	<div class="modal-body">
		<div class="form-group @php($err_descripcion = $errors->has('descripcion')?'has-error':'') {{$err_descripcion}}">
			<label for="descripcion">Descripcion</label>
			 <input type="text" value="{{ old('descripcion') }}"  name="descripcion" id="descripcion" class="form-control"/ required>
			 @if ($errors->has('descripcion'))
			 	<span class="help-block">{{ $errors->first('descripcion') }}</span>
			 @endif
		</div>
    <div class="form-group @php($err_saldo = $errors->has('saldo')?'has-error':'') {{$err_saldo}}">
			<label for="descripcion">Saldo inicial</label>
			 <input type="text" value="{{ old('saldo') }}" name="saldo" id="saldo" value="0.00" class="form-control"/ required>
			 @if ($errors->has('saldo'))
			 	<span class="help-block">{{ $errors->first('saldo') }}</span>
			 @endif
		</div>
	</div>
	<div class="modal-footer">
    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
		<input type="submit" class="btn btn-success" value="Guardar">
	</div>
</form>

@overwrite
