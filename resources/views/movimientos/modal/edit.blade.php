@extends('_template.modal')

@section('modalbody')

<form action="{{ route('movimientos.update',['id'=>$movimiento->id]) }}" method="POST" enctype="multipart/form-data">
    {{ csrf_field () }}
    {{ method_field('PUT') }}
    <input type="hidden"  name="id" id="id" value="{{$movimiento->id}}"/>
		<div class="modal-header">
			<h4 class="modal-title">Editar Movimiento</h4>

			<a href="{{route('vivienda.index')}}" class="close" data-dismiss="modal" aria-hidden="true">&times;</a>
		</div>
		<div class="modal-body">

      <div class="box-body">
        <div class="form-group @php($err_descripcion = $errors->has('descripcion')?'has-error':'') {{$err_descripcion}}">
  				<label for="descripcion">Descripcion</label>
  				 <input type="text"  name="descripcion" id="descripcion" value="{{$movimiento->descripcion}}" class="form-control"/ required>
  			</div>
        <div class="col-md-6">
          <div class="form-group @php($err_fecha = $errors->has('fecha')?'has-error':'') {{$err_fecha}}" >
            <label for="fecha">Fecha Movimiento</label>
            <div class="input-group date">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              <input type="text" value="{{$movimiento->fecMov}}" name="fecha" id="fecha" class="form-control fechas" required/>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="bootstrap-timepicker">
          <div class="form-group @php($err_hora = $errors->has('hora')?'has-error':'') {{$err_hora}}">
             <label>Hora:</label>
             <div class="input-group">
               <input name="hora" value="{{$movimiento->fecMov}}" type="text" class="form-control timepicker">
               <div class="input-group-addon">
                 <i class="fa fa-clock-o"></i>
               </div>
             </div>
             <!-- /.input group -->
           </div>
           <!-- /.form group -->
         </div>
        </div>
        <div class="form-group @php($err_compIngreso = $errors->has('compIngreso')?'has-error':'') {{$err_compIngreso}}">
          <label for="comprobante">Comprobante</label>
          <input type="file" id="comprobante" name="comprobante">
        </div>
      </div>
		</div>
		<div class="modal-footer">
      <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
			<button id="btnSubmit{{$movimiento->id}}" type="submit" class="btn btn-success enviar" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Procesando...">Guardar</button>
		</div>
	</form>

@overwrite

@section('modalscripts')

@endsection
