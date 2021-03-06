@extends('_template.modal')

@section('modalbody')
<form action="{{ route('documento.store') }}" method="POST" enctype="multipart/form-data">
  {{ csrf_field () }}
	<div class="modal-header">
		<h4 class="modal-title">Crear Documento</h4>
		<a href="{{route('documento.index')}}" class="close" data-dismiss="modal" aria-hidden="true">&times;</a>
	</div>
	<div class="modal-body">
		<div class="form-group @php($err_titulo = $errors->has('titulo')?'has-error':'') {{$err_titulo}}">
			<label for="titulo">Titulo</label>
			 <input type="text" value="{{ old('titulo') }}" name="titulo" id="titulo" class="form-control"/ required>
       @if ($errors->has('titulo'))
			 	<span class="help-block">{{ $errors->first('titulo') }}</span>
			 @endif
		</div>
    <div class="form-group @php($err_descripcion = $errors->has('descripcion')?'has-error':'') {{$err_descripcion}}">
			<label for="descripcion">Descripcion</label>
			 <textarea rows="3" placeholder="Descripcion..." value="{{ old('descripcion') }}" name="descripcion" id="descripcion" class="form-control"/ required ></textarea>
       @if ($errors->has('descripcion'))
			 	<span class="help-block">{{ $errors->first('descripcion') }}</span>
			 @endif
		</div>
    <div class="form-group @php($err_archivo = $errors->has('archivo')?'has-error':'') {{$err_archivo}}">
			<label for="archivo">Archivo</label>
			 <input type="file" id="archivo" name="archivo">
       @if ($errors->has('archivo'))
			 	<span class="help-block">{{ $errors->first('archivo') }}</span>
			 @endif
		</div>
	</div>
	<div class="modal-footer">
    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
		<button type="submit" class="btn btn-success enviar" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Procesando...">Guardar</button>
	</div>
</form>

@overwrite
