@extends('_template.modal')

@section('modalbody')
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
          <div class="form-group @php($err_descIngreso = $errors->has('descIngreso')?'has-error':'') {{$err_descIngreso}}">
            <label for="descIngreso">Descripcion</label>
             <input type="text"  name="descIngreso" id="descIngreso" class="form-control"/ required>
          </div>
          <div class="form-group @php($err_ingresoImporte = $errors->has('ingresoImporte')?'has-error':'') {{$err_ingresoImporte}}">
            <label for="ingresoImporte">Importe</label>
             <input type="text"  name="ingresoImporte" id="ingresoImporte" value="" class="form-control"/ required>
          </div>
          <div class="col-md-6">
            <div class="form-group @php($err_fecIngreso = $errors->has('fecIngreso')?'has-error':'') {{$err_fecIngreso}}" >
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
            <div class="form-group @php($err_timeIngreso = $errors->has('timeIngreso')?'has-error':'') {{$err_timeIngreso}}">
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
          <div class="form-group @php($err_compIngreso = $errors->has('compIngreso')?'has-error':'') {{$err_compIngreso}}">
            <label for="compIngreso">Comprobante</label>
            <input type="file" id="compIngreso" name="compIngreso">
          </div>
        </div>
        <div class="modal-footer">
          <a href="{{route('cuentas.show',['id'=>$cuenta->id])}}" class="btn btn-default">Cancelar</a>
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
          <div class="form-group @php($err_descEgreso = $errors->has('descEgreso')?'has-error':'') {{$err_descEgreso}}">
            <label for="descEgreso">Descripcion</label>
             <input type="text"  name="descEgreso" id="descEgreso" class="form-control"/ required>
          </div>
          <div class="form-group @php($err_egresoImporte = $errors->has('egresoImporte')?'has-error':'') {{$err_egresoImporte}}">
            <label for="egresoImporte">Importe</label>
             <input type="text"  name="egresoImporte" id="egresoImporte" value="" class="form-control"/ required>
          </div>
					<div class="col-md-6">
            <div class="bootstrap-timepicker">
          <div class="form-group @php($err_fecEgreso = $errors->has('fecEgreso')?'has-error':'') {{$err_fecEgreso}}">
            <label for="fecEgreso">Fecha Egreso</label>
            <div class="input-group date">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              <input type="text"  name="fecEgreso" id="fecEgreso" class="form-control"/ required>
            </div>
          </div>
				</div>
			</div>
					<div class="col-md-6">
            <div class="bootstrap-timepicker">
            <div class="form-group @php($err_timeEgreso = $errors->has('timeEgreso')?'has-error':'') {{$err_timeEgreso}}">
               <label>Time picker:</label>
               <div class="input-group">
                 <input name="timeEgreso" type="text" class="form-control timepicker">
                 <div class="input-group-addon">
                   <i class="fa fa-clock-o"></i>
                 </div>
               </div>
               <!-- /.input group -->
             </div>
             <!-- /.form group -->
           </div>
          </div>
          <div class="form-group @php($err_compEgreso = $errors->has('compEgreso')?'has-error':'') {{$err_compEgreso}}">
            <label for="compEgreso">Comprobante</label>
            <input type="file" id="compEgreso" name="compEgreso">
          </div>
        </div>
        <div class="modal-footer">
          <a href="{{route('cuentas.show',['id'=>$cuenta->id])}}" class="btn btn-default">Cancelar</a>
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
            <div class="form-group @php($err_transferImporte = $errors->has('transferImporte')?'has-error':'') {{$err_transferImporte}}">
              <label for="transferImporte">Importe</label>
               <input type="text"  name="transferImporte" id="transferImporte" value="" class="form-control"/ required>
            </div>
            <div class="form-group @php($err_cuenta_id = $errors->has('cuenta_id')?'has-error':'') {{$err_cuenta_id}}">
              <label for="cuenta_id">Cuenta Destino</label>
              <select class="form-control select2" id="cta_dest" name="cta_dest">
                @foreach($cuentas as $item)
                  <option value="{{$item->id}}">{{$item->descripcion}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group @php($err_fecTransfer = $errors->has('fecTransfer')?'has-error':'') {{$err_fecTransfer}}">
              <label for="fecTransfer">Fecha Transferencia</label>
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="text"  name="fecTransfer" id="fecTransfer" class="form-control"/ required>
              </div>
            </div>
            <div class="bootstrap-timepicker">
              <div class="form-group @php($err_timeTransfer = $errors->has('timeTransfer')?'has-error':'') {{$err_timeTransfer}}">
                 <label>Time picker:</label>
                 <div class="input-group">
                   <input name="timeTransfer" type="text" class="form-control timepicker">
                   <div class="input-group-addon">
                     <i class="fa fa-clock-o"></i>
                   </div>
                 </div>
                 <!-- /.input group -->
               </div>
             <!-- /.form group -->
           </div>
          </div>
          <div class="modal-footer">
            <a href="{{route('cuentas.show',['id'=>$cuenta->id])}}" class="btn btn-default">Cancelar</a>
            <input type="submit" class="btn btn-success" value="Aceptar">
          </div>
        </form>
      </div>
      <!-- /.box-body -->
    </div>
  </div>
</div>
@overwrite
