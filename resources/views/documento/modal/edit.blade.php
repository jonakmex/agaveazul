@extends('_template.modal')

@section('modalbody')
<form action="{{ route('documento.update',['id'=>$documento->id]) }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field () }}
                    {{ method_field('PUT') }}
	<div class="modal-header">
		<h4 class="modal-title">Editar Documento</h4>
		<a href="{{route('documento.index')}}" class="close" data-dismiss="modal" aria-hidden="true">&times;</a>
	</div>
	<div class="modal-body">

    <div class="form-group @php($err_titulo = $errors->has('titulo')?'has-error':'') {{$err_titulo}}">
			<label for="titulo">Titulo</label>
			 <input type="text" value="{{ $documento->titulo }}" name="titulo" id="titulo" class="form-control"/ required>
       @if ($errors->has('titulo'))
			 	<span class="help-block">{{ $errors->first('titulo') }}</span>
			 @endif
		</div>
    <div class="form-group @php($err_descripcion = $errors->has('descripcion')?'has-error':'') {{$err_descripcion}}">
			<label for="descripcion">Descripcion</label>
			 <textarea rows="3" placeholder="Descripcion..." name="descripcion" id="descripcion" class="form-control"/ required >{{ $documento->descripcion }}</textarea>
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
		<input type="submit" class="btn btn-success" value="Guardar">
	</div>
</form>

@overwrite
