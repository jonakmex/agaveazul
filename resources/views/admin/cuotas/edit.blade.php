@extends('common.user')
@section('styles')
<!-- iCheck for checkboxes and radio inputs -->
 <link rel="stylesheet" href="{{asset('dashboard/plugins/iCheck/all.css')}}">
@endsection
@section('content')

<div class="container">
		<div class="modal-dialog">
			<div class="modal-content">
				<form action="{{route('cuotas.update',['id'=>$cuota->id])}}" method="POST">
                    {{ csrf_field () }}
                    {{ method_field('PUT') }}
					<div class="modal-header">
						<h4 class="modal-title">Editar Cuota {{$cuota->descripcion}}</h4>
						<a href="#" class="close" data-dismiss="modal" aria-hidden="true">&times;</a>
					</div>
					<div class="modal-body">
            <div class="row">
            <div class="col-md-6">
  						<div class="form-group">
  							<label for="descripcion">Descripcion</label>
  							 <input type="text" value="{{$cuota->descripcion}}"  name="descripcion" id="descripcion" class="form-control"/ required>
  						</div>
              <!-- IP mask -->
              <div class="form-group">
                <label>Importe:</label>
                  <input id="importe" value="{{$cuota->importe}}" name="importe" type="text" class="form-control">
                <!-- /.input group -->
              </div>
              <!-- /.form group -->
              <!-- Date -->
              <div class="form-group">
                <label>Fecha:</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" value="{{$cuota->fecPago}}" class="form-control pull-right" id="fecPago" name="fecPago">
                </div>
                <!-- /.input group -->
              </div>
              <div class="form-group">
                <label>Periodo de gracia</label>
                <select class="form-control select2" value="{{$cuota->periodoGracia}}" name="periodoGracia" id="periodoGracia" style="width: 100%;">
                  <option {{$cuota->periodoGracia == 0 ? "selected" : ""}} value="0">0 Dias</option>
                  <option {{$cuota->periodoGracia == 5 ? "selected" : ""}} value="5">5 Dias</option>
                  <option {{$cuota->periodoGracia == 10 ? "selected" : ""}} value="10">10 Dias</option>
                  <option {{$cuota->periodoGracia == 15 ? "selected" : ""}} value="15">15 Dias</option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <!-- /.form group -->
              <div class="form-group">
                <label for="chkRpt">
                  <input id="chkRpt" type="checkbox" {{$cuota->periodicidad != null ? "checked" : ""}} class="flat-red" name="chkRpt"/>
                    Repetir
                </label>
              </div>

              <div id="dvRpt" class="form-group" style="{{$cuota->periodicidad == null ? "display: none" : ""}}">
                <label>Periodicidad</label>
                <select class="form-control select2" value="{{$cuota->periodicidad}}" name="periodicidad" id="periodicidad" style="width: 100%;">
                  <option {{$cuota->periodicidad == 1 ? "selected" : ""}} value="1">Mensual</option>
                  <option {{$cuota->periodicidad == 2 ? "selected" : ""}} value="2">Anual</option>
                </select>
              </div>

              <div id="dvNPeriodos" class="form-group" style="{{$cuota->periodicidad == null ? "display: none" : ""}}">
                <label>Repeticiones</label>
                <input id="nPeriodos" name="nPeriodos"  value="{{$cuota->nPeriodos}}" type="text" class="form-control">
              </div>

            </div>
					</div>
        </div>
					<div class="modal-footer">
                        <a href="{{route('cuotas.show',['id'=>$cuota->id])}}" class="btn btn-default">Cancelar</a>
						<input type="submit" class="btn btn-success" value="Guardar">
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
    $('#fecPago').datepicker({
      autoclose: true,
      dateFormat: "yy-mm-dd"
    });

    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass: 'iradio_flat-green'
    });

    $('#chkRpt').on('ifChecked', function(event){
      $("#dvRpt").show();
      $("#dvNPeriodos").show();
    });

    $('#chkRpt').on('ifUnchecked', function(event){
      $("#dvRpt").hide();
      $("#dvNPeriodos").hide();
    });

    //Money Euro

    $("#importe").inputmask({ alias : "pesos", prefix: '$' });
    $("#nPeriodos").inputmask({ alias : "integer" });

});
</script>

@endsection
