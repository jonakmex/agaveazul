@extends('_template.modal')

@section('modalbody')
<form action="{{ route('pagos.update',['id'=>$recibo->id]) }}" method="POST" enctype="multipart/form-data">
    {{ csrf_field () }}
    {{ method_field('PUT') }}

    <input name="rec_id" id="rec_id" value="{{$recibo->id}}" hidden/>
		<div class="modal-header">
			<h4 class="modal-title">Editar Recibo</h4>

			<a href="{{route('vivienda.index')}}" class="close" data-dismiss="modal" aria-hidden="true">&times;</a>
		</div>
		<div class="modal-body">
			<div class="form-group">
				<label for="descripcion">Importe</label>
				 <input type="text" readonly  name="importe" id="importe" value="{{$recibo->importe}}" class="form-control currency"/ required>
			</div>
			<div class="form-group">
				<label for="descripcion">Ajuste</label>
				 <input type="text"  name="ajuste" id="ajuste" value="{{$recibo->ajuste}}" class="form-control currency"/ required>
					@if ($errors->has('ajuste'))
					    <div class="error">{{ $errors->first('ajuste') }}</div>
					@endif
			</div>
			<div class="col-md-6">
				<div class="bootstrap-timepicker">
      <div class="form-group">
				<label for="descripcion">Fecha Pago</label>

				<div class="input-group date">
					<div class="input-group-addon">
						<i class="fa fa-calendar"></i>
					</div>
					<input type="text"  name="fecPago" id="fecPago" class="form-control fechas" value="{{$recibo->movimiento->fecMov}}" required/>
				</div>
				 @if ($errors->has('fecPago'))
						 <div class="error">{{ $errors->first('fecPago') }}</div>
				 @endif
			</div>
			</div>
			</div>
			<div class="col-md-6">
				<div class="bootstrap-timepicker">
				<div class="form-group">
					 <label>Time picker:</label>
					 <div class="input-group">
						 <input name="timeIngreso" value="{{$recibo->movimiento->fecMov}}" type="text" class="form-control timepicker">
						 <div class="input-group-addon">
							 <i class="fa fa-clock-o"></i>
						 </div>
					 </div>
					 <!-- /.input group -->
				 </div>
				 <!-- /.form group -->
			 </div>
			</div>
      <div class="form-group">
				<label for="cuenta_id">Tipo Pago</label>
				<select class="form-control select2" id="tipo_pago" name="tipo_pago">
				 		<option value="1" {{$recibo->tipo_pago==1?'selected':''}} >Transferencia</option>
            <option value="2" {{$recibo->tipo_pago==2?'selected':''}}>Depósito</option>
            <option value="3" {{$recibo->tipo_pago==3?'selected':''}}>Efectivo</option>
				</select>
				 @if ($errors->has('tipo_pago'))
						 <div class="error">{{ $errors->first('tipo_pago') }}</div>
				 @endif
			</div>
			<div class="form-group">
				<label for="cuenta_id">Cuenta</label>

				<select class="form-control select2" id="cuenta_id" name="cuenta_id">
					@foreach($cuentas as $cuenta)
				 		<option value="{{$cuenta->id}}" {{$recibo->movimiento->cuenta->id==$cuenta->id?'selected':''}}>{{$cuenta->descripcion}}</option>
					@endforeach
				</select>
				 @if ($errors->has('cuenta'))
						 <div class="error">{{ $errors->first('cuenta') }}</div>
				 @endif
			</div>
      <div class="form-group">
        <label for="comprobante">Comprobante</label>
        <input type="file" id="comprobante" name="comprobante">
				@if ($errors->has('comprobante'))
						<div class="error">{{ $errors->first('comprobante') }}</div>
				@endif
      </div>
		</div>
		<div class="modal-footer">
      <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
			<button id="btnSubmit{{$recibo->id}}" type="submit" class="btn btn-success enviar" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Procesando...">Procesar</button>
		</div>
	</form>

@overwrite

@section('modalscripts')

@endsection
