@extends('_template.modal')

@section('modalbody')
<form>
	<div class="modal-header">
		<h4 class="modal-title">Delete Employee</h4>
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	</div>
	<div class="modal-body">
		<p>Are you sure you want to delete these Records?</p>
		<p class="text-warning"><small>This action cannot be undone.</small></p>
	</div>
	<div class="modal-footer">
		<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
		<button type="submit" class="btn btn-danger enviar" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Procesando...">Delete</button>
	</div>
</form>
@overwrite
