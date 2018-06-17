@extends('common.user')
@section('styles')
<!-- Bootstrap time Picker -->
<link rel="stylesheet" href="{{asset('dashboard/plugins/timepicker/bootstrap-timepicker.min.css')}}">
@endsection
@section('content')

<div class="container">
		<div class="modal-dialog">
			<div class="modal-content">
        <ul class="nav nav-tabs">
          <li class="active"><a data-toggle="tab" href="#income">Ingreso</a></li>
          <li><a data-toggle="tab" href="#expense">Egreso</a></li>
          <li><a data-toggle="tab" href="#transfer">Transfer</a></li>
        </ul>
        <div class="tab-content">
          <div id="income" class="tab-pane fade in active">
            <div class="box box-danger">
              <div class="box-body">
                <form action="{{route('movimientos.store')}}" method="POST" enctype="multipart/form-data">
                  {{ csrf_field () }}
                <input name="cuenta_id" value="{{$cuenta->id}}" hidden/>
                <input name="tipo" value="1" hidden/>
                <div class="modal-body">
                  <div class="form-group">
                    <label for="descripcion">Descripcion</label>
                     <input type="text"  name="descripcion" id="descripcion" class="form-control"/ required>
                  </div>
                  <div class="form-group">
                    <label for="descripcion">Importe</label>
                     <input type="text"  name="ingresoImporte" id="ingresoImporte" value="" class="form-control"/ required>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="fecIngreso">Fecha Ingreso</label>
                      <div class="input-group date">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text"  name="fecIngreso" id="fecIngreso" class="form-control"/ required>
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
                    <label for="compIngreso">Comprobante</label>
                    <input type="file" id="compIngreso" name="compIngreso">
                  </div>
                </div>
                <div class="modal-footer">
                  <a href="" class="btn btn-default">Cancelar</a>
                  <input type="submit" class="btn btn-success" value="Aceptar">
                </div>
              </form>
              </div>
              <!-- /.box-body -->
            </div>
          </div>
          <div id="expense" class="tab-pane fade in">
            <div class="box box-danger">
              <div class="box-body">
                <form action="{{route('movimientos.store')}}" method="POST" enctype="multipart/form-data">
                  {{ csrf_field () }}
                <input name="cuenta_id" value="{{$cuenta->id}}" hidden/>
                <input name="tipo" value="2" hidden/>
                <div class="modal-body">
                  <div class="form-group">
                    <label for="descripcion">Descripcion</label>
                     <input type="text"  name="descripcion" id="descripcion" class="form-control"/ required>
                  </div>
                  <div class="form-group">
                    <label for="descripcion">Importe</label>
                     <input type="text"  name="egresoImporte" id="egresoImporte" value="" class="form-control"/ required>
                  </div>
                  <div class="form-group">
                    <label for="fecEgreso">Fecha Egreso</label>
                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text"  name="fecEgreso" id="fecEgreso" class="form-control"/ required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="compEgreso">Comprobante</label>
                    <input type="file" id="compEgreso" name="compEgreso">
                  </div>
                </div>
                <div class="modal-footer">
                  <a href="" class="btn btn-default">Cancelar</a>
                  <input type="submit" class="btn btn-success" value="Aceptar">
                </div>
              </form>
              </div>
              <!-- /.box-body -->
            </div>
          </div>
          <div id="transfer" class="tab-pane fade in">
            <div class="box box-danger">
              <div class="box-body">
                <form action="{{route('movimientos.store')}}" method="POST">
                  {{ csrf_field () }}
                  <input name="cuenta_id" value="{{$cuenta->id}}" hidden/>
                  <input name="tipo" value="3" hidden/>
                  <div class="modal-body">
                    <div class="form-group">
                      <label for="descripcion">Importe</label>
                       <input type="text"  name="transferImporte" id="transferImporte" value="" class="form-control"/ required>
                    </div>
                    <div class="form-group">
        							<label for="cuenta_id">Cuenta Destino</label>
        							<select class="form-control select2" id="cta_dest" name="cta_dest">
                        @foreach($cuentas as $item)
        							 		<option value="{{$item->id}}">{{$item->descripcion}}</option>
        								@endforeach
        							</select>
        						</div>
                    <div class="form-group">
                      <label for="descripcion">Fecha Transferencia</label>
                      <div class="input-group date">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text"  name="fecTransfer" id="fecTransfer" class="form-control"/ required>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <a href="" class="btn btn-default">Cancelar</a>
                    <input type="submit" class="btn btn-success" value="Aceptar">
                  </div>
                </form>
              </div>
              <!-- /.box-body -->
            </div>
          </div>
        </div>
        <!-- /.box -->
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
            clearMaskOnLostFocus: true
        }
});

$(function () {
  var date = new Date();
  var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
    $('#fecTransfer').datepicker({
      autoclose: true,
      format: "yyyy-mm-dd"
    });
    $('#fecIngreso').datepicker({
      autoclose: true,
      format: "yyyy-mm-dd"
    });
    $('#fecEgreso').datepicker({
      autoclose: true,
      format: "yyyy-mm-dd"
    });

    $('#fecIngreso').datepicker('setDate', today);
    $('#fecEgreso').datepicker('setDate', today);
    $('#fecTransfer').datepicker('setDate', today);

    //Money Euro
    $("#transferImporte").inputmask({ alias : "pesos", prefix: '$',removeMaskOnSubmit: true });
    $("#ingresoImporte").inputmask({ alias : "pesos", prefix: '$',removeMaskOnSubmit: true });
    $("#egresoImporte").inputmask({ alias : "pesos", prefix: '$',removeMaskOnSubmit: true });

    //Timepicker
    $(".timepicker").timepicker({
      showInputs: false
    });

});
</script>

@endsection
