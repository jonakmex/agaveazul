@extends('_template.modal')

@section('modalbody')
<form action="{{route('staff.store')}}" method="POST">
  {{ csrf_field () }}
	<div class="modal-header">
		<h4 class="modal-title">Crear Usuario</h4>
		<a href="{{route('staff.index')}}" class="close" data-dismiss="modal" aria-hidden="true">&times;</a>
	</div>
	<div class="modal-body">
		<div class="form-group @php($err_nombre = $errors->has('nombre')?'has-error':'') {{$err_nombre}}">
			<label for="nombre">Nombre</label>
			 <input type="text" value="{{ old('nombre') }}" name="nombre" id="nombre" class="form-control"/ required>
            @if ($errors->has('nombre'))
			 	<span class="help-block">{{ $errors->first('nombre') }}</span>
			 @endif
		</div>

        <div class="form-group @php($err_apellido = $errors->has('apellido')?'has-error':'') {{$err_apellido}}">
			<label for="apellido">Apellido</label>
			 <input type="text" value="{{ old('apellido') }}" name="apellido" id="apellido" class="form-control"/ required>
            @if ($errors->has('apellido'))
			 	<span class="help-block">{{ $errors->first('apellido') }}</span>
			 @endif
		</div>

		<div class="form-group @php($err_email = $errors->has('email')?'has-error':'') {{$err_email}}">
			<label for="email">Email</label>
			 <input type="text" value="{{ old('email') }}" name="email" id="email" class="form-control"/ required>
            @if ($errors->has('email'))
			 	<span class="help-block">{{ $errors->first('email') }}</span>
			 @endif
		</div>

        
	</div>
	<div class="modal-footer">
    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
		<button type="submit" class="btn btn-success enviar" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Procesando...">Guardar</button>
	</div>
</form>

@overwrite
