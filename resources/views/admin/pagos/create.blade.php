@extends('common.user')
@section('styles')
<!-- Bootstrap time Picker -->
<link rel="stylesheet" href="{{asset('dashboard/plugins/timepicker/bootstrap-timepicker.min.css')}}">
@endsection
@section('content')


<div class="container">
		<div class="modal-dialog">
			<div class="modal-content">
				<form action="{{ route('pagos.store') }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field () }}
					<input name="rec_id" id="rec_id" value="{{$form['recibo']->id}}" hidden/>
					<div class="modal-header">
						<h4 class="modal-title">Pagar Recibo</h4>

						<a href="{{route('vivienda.index')}}" class="close" data-dismiss="modal" aria-hidden="true">&times;</a>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label for="descripcion">Importe</label>
							 <input type="text" readonly  name="importe" id="importe" value="{{$form['recibo']->importe}}" class="form-control"/ required>
						</div>
						<div class="form-group">
							<label for="descripcion">Ajuste</label>
							 <input type="text"  name="ajuste" id="ajuste" value="0" class="form-control"/ required>
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
								<input type="text"  name="fecPago" id="fecPago" class="form-control"/ required>
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
									 <input name="timeIngreso" type="text" class="form-control timepicker">
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
							<label for="cuenta_id">Cuenta</label>
							<select class="form-control select2" id="cuenta_id" name="cuenta_id">
								@foreach($form['cuentas'] as $cuenta)
							 		<option value="{{$cuenta->id}}">{{$cuenta->descripcion}}</option>
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
                        <a href="{{route('recibos.show','id=1')}}" class="btn btn-default">Cancelar</a>
						<input type="submit" class="btn btn-success" value="Pagar">
					</div>
				</form>
			</div>
		</div>
    </div>

@endsection

@section('scripts')
<script src="{{asset('dashboard/plugins/datepicker/bootstrap-datepicker.js')}}"></script>
<script src="{{asset('dashboard/plugins/iCheck/icheck.min.js')}}"></script>
<!-- InputMask -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.2.6/jquery.inputmask.bundle.min.js"></script>

<!-- bootstrap time picker -->
<script src="{{asset('dashboard/plugins/timepicker/bootstrap-timepicker.min.js')}}"></script>

<script>
Inputmask.extendAliases({
  pesos: {
            prefix: "₱ ",
            groupSeparator: ".",
            alias: "numeric",
            placeholder: "0",
            autoGroup: !0,
            digits: 2,
            digitsOptional: !1,
            clearMaskOnLostFocus: !1
        }
});

$(function () {
		var date = new Date();
		var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
    $('#fecPago').datepicker({
      autoclose: true,
      format: "yyyy-mm-dd"
    });

		$('#fecPago').datepicker('setDate', today);

    //Money Euro
    $("#importe").inputmask({ alias : "pesos", prefix: '$' });
		$("#ajuste").inputmask({ alias : "pesos", prefix: '$' ,removeMaskOnSubmit: true});

		//Timepicker
    $(".timepicker").timepicker({
      showInputs: false
    });
		console.log('Ok');

});
</script>

@endsection
