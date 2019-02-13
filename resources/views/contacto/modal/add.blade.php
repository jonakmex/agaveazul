@extends('_template.modal')

@section('modalbody')
<form action="{{route('residentes.store')}}" method="POST">
                    {{ csrf_field () }}
          <input name="vivienda_id" id="vivienda_id" value="{{$vivienda->id}}" hidden/>
					<div class="modal-header">
						<h4 class="modal-title">Registrar Contacto</h4>
						<a href="#" class="close" data-dismiss="modal" aria-hidden="true">&times;</a>
					</div>
					<div class="modal-body">
						<div class="form-group @php($err_nombre = $errors->has('nombre')?'has-error':'') {{$err_nombre}}">
							<label for="nombre">Nombre</label>
							 <input type="text"  name="nombre" id="nombre" class="form-control"/ required>
							 @if ($errors->has('nombre'))
							 	<span class="help-block">{{ $errors->first('nombre') }}</span>
							 @endif
						</div>
            <div class="form-group @php($err_telefono = $errors->has('telefono')?'has-error':'') {{$err_telefono}}">
							<label for="telefono">Telefono</label>
							 <input type="text"  name="telefono" id="telefono" class="form-control"/ required>
							 @if ($errors->has('telefono'))
							 	<span class="help-block">{{ $errors->first('telefono') }}</span>
							 @endif
						</div>
            <div class="form-group @php($err_email = $errors->has('email')?'has-error':'') {{$err_email}}">
							<label for="email">Correo</label>
							 <input type="text"  name="email" id="email" class="form-control"/ required>
							 @if ($errors->has('email'))
							 	<span class="help-block">{{ $errors->first('email') }}</span>
							 @endif
						</div>
            <div class="form-group @php($err_tipo = $errors->has('tipo')?'has-error':'') {{$err_tipo}}">
							<label for="tipo">Tipo</label>
							 <select type="text"  name="tipo" id="tipo" class="form-control"/ required>
                  <option value="1">Propietario</option>
                  <option value="2">Inquilino</option>
                  <option value="3">Representante</option>
               </select>
							 @if ($errors->has('tipo'))
							 	<span class="help-block">{{ $errors->first('tipo') }}</span>
							 @endif
						</div>
            <span class="custom-checkbox">
              <input id="chkPrincipal" type="checkbox"  class="flat-red" name="chkPrincipal"/>
              <label for="chkPrincipal">Principal</label>
            </span>
					</div>
					<div class="modal-footer">
            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
						<button type="submit" class="btn btn-success enviar" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Procesando..." >Guardar</button>
					</div>
				</form>

@overwrite
