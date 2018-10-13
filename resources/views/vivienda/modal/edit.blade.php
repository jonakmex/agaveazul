@extends('_template.modal')

@section('modalbody')
<form action="{{ route('vivienda.update',['id'=>$vivienda->id]) }}" method="POST">
                    {{ csrf_field () }}
                    {{ method_field('PUT') }}
	<div class="modal-header">
		<h4 class="modal-title">Editar Vivienda</h4>
		<a href="{{route('vivienda.index')}}" class="close" data-dismiss="modal" aria-hidden="true">&times;</a>
	</div>
	<div class="modal-body">

		<div class="form-group @php($err_descripcion = $errors->has('descripcion')?'has-error':'') {{$err_descripcion}}">
			<label for="descripcion">Descripcion</label>
			 <input type="text" value="{{$vivienda->descripcion}}" name="descripcion" id="descripcion" class="form-control"/ required>
			 @if ($errors->has('descripcion'))
			 	<span class="help-block">{{ $errors->first('descripcion') }}</span>
			 @endif
		</div>
	</div>
	<div class="modal-footer">
                <a href="{{route('vivienda.index')}}" class="btn btn-default">Cancelar</a>
		<input type="submit" class="btn btn-success" value="Guardar">
	</div>
</form>

@overwrite
