@extends('_template.modal')

@section('modalbody')
<div class="modal-header">
  <h4 class="modal-title">Error</b></h4>
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
</div>
<div class="modal-body">
  <p>No fue posible realizar la accion</p>

</div>
<div class="modal-footer">
  <input type="button" class="btn btn-danger" data-dismiss="modal" value="Aceptar">
</div>
@overwrite
