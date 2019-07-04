@extends('_template.modal')

@section('modalbody')
<form action="{{route('cuentas.index')}}" method="GET">
	<div class="modal-header">
		<h4 class="modal-title">Buscar Cuenta</h4>
		<a href="#" class="close" data-dismiss="modal" aria-hidden="true">&times;</a>
	</div>
	<div class="modal-body">

		<div class="form-group ">
			<label for="descripcion">Descripcion</label>
			 <input type="text" value="" name="descripcion" id="descripcion" class="form-control"/ required>
		</div>
	</div>
	<div class="modal-footer">
    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
		<button type="submit" class="btn btn-success enviar" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Procesando..."></i>Buscar</button>
	</div>
</form>
@overwrite


