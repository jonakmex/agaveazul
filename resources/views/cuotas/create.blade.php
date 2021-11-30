@extends('_template.dashboard')

@section('title')
  <title>Home</title>
@endsection

@section('styles')
  <link href="{{asset('css/custom-checkbox.css')}}" rel="stylesheet">
  <link href="{{asset('css/custom-table.css')}}" rel="stylesheet">
  <link href="{{asset('css/custom-modal.css')}}" rel="stylesheet">
  <link href="{{asset('css/custom-pagination.css')}}" rel="stylesheet">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('dashboard/plugins/datatables/dataTables.bootstrap.css')}}">
@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <section class="content-header">
      <h1>
        Cuotas
        <small>Crear</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Forms</a></li>
        <li class="active">Advanced Elements</li>
      </ol>
    </section>

    <section class="content">
    <div class="row">
        <div class="col-xs-12">
          <div class="box">
				<form action="{{route('cuotas.store')}}" method="POST">
                    {{ csrf_field () }}
					<div class="modal-header">
						<h4 class="modal-title">Crear Cuota</h4>
						<a href="#" class="close" data-dismiss="modal" aria-hidden="true">&times;</a>
					</div>
					<div class="modal-body">
            <div class="row">
            <div class="col-md-6">
  						<div class="form-group @php($err_descripcion = $errors->has('descripcion')?'has-error':'') {{$err_descripcion}}">
  							<label for="descripcion">Descripcion</label>
  							 <input type="text" value="{{old('descripcion')}}"  name="descripcion" id="descripcion" class="form-control"/ required>
                 @if ($errors->has('descripcion'))
  							 	<span class="help-block">{{ $errors->first('descripcion') }}</span>
  							 @endif
  						</div>
              <div class="form-group @php($err_clave = $errors->has('clave')?'has-error':'') {{$err_clave}}">
  							<label for="clave">Clave</label>
  							 <input type="text" value="{{old('clave')}}"  name="clave" id="clave" class="form-control"/ required>
                 @if ($errors->has('clave'))
  							 	<span class="help-block">{{ $errors->first('clave') }}</span>
  							 @endif
  						</div>
              <!-- IP mask -->
              <div class="form-group @php($err_importe = $errors->has('importe')?'has-error':'') {{$err_importe}}">
                <label>Importe:</label>
                  <input id="importe" value="{{old('importe')}}" name="importe" type="text" class="form-control">
                  @if ($errors->has('importe'))
     							 	<span class="help-block">{{ $errors->first('importe') }}</span>
     							@endif
                <!-- /.input group -->
              </div>
              <!-- /.form group -->
              <!-- Date -->
              <div class="form-group @php($err_fecPago = $errors->has('fecPago')?'has-error':'') {{$err_fecPago}}">
                <label>Fecha:</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" value="{{old('fecPago')}}" class="form-control pull-right" id="fecPago" name="fecPago">
                  @if ($errors->has('fecPago'))
     							 	<span class="help-block">{{ $errors->first('fecPago') }}</span>
     							@endif
                </div>
                <!-- /.input group -->
              </div>

              <!-- /.form group -->
              <div class="form-group">
                <span class="custom-checkbox">
                  <input id="chkRpt" type="checkbox"  class="flat-red" name="chkRpt"/>
                  <label for="chkRpt">Repetir</label>
                </span>
              </div>

              <div id="dvRpt" class="form-group" style="display: none">
                <label>Periodicidad</label>
                <select class="form-control select2" name="periodicidad" id="periodicidad" style="width: 100%;">
                  <option value="1">Mensual</option>
                  <option value="2">Anual</option>
                </select>
              </div>

              <div id="dvNPeriodos" class="form-group" style="display: none">
                <label>Repeticiones</label>
                <input id="nPeriodos" name="nPeriodos" value="{{old('nPeriodos')}}" type="text" class="form-control">
                @if ($errors->has('nPeriodos'))
                  <span class="help-block">{{ $errors->first('nPeriodos') }}</span>
                @endif
              </div>
              
              <div id="dvPeriodoGracia" class="form-group">
                <label>Dias de Gracia</label>
                <input id="periodoGracia" name="periodoGracia" value="{{old('periodoGracia')}}" type="text" class="form-control">
                @if ($errors->has('periodoGracia'))
                  <span class="help-block">{{ $errors->first('periodoGracia') }}</span>
                @endif
              </div>
              
            </div>

            <div class="col-md-6">
              <table class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th width="10%">
        							<span class="custom-checkbox">
        								<input type="checkbox" id="selectAll">
        								<label for="selectAll"></label>
        							</span>
        						</th>
                    <th>Vivienda</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($viviendas as $vivienda)
                  <tr>
                    <td>
                      <span class="custom-checkbox">
        								<input type="checkbox" id="checkbox1" name="selected[]" value="{{$vivienda->id}}">
        								<label for="checkbox1"></label>
        							</span>
                    </td>
                    <td>{{$vivienda->descripcion}}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
					</div>
        </div>
					<div class="modal-footer">
                        <a href="{{route('cuotas.index')}}" class="btn btn-default">Cancelar</a>
						<button type="submit" class="btn btn-success enviar" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Procesando...">Guardar</button>
					</div>
				</form>
      </div>
      </div>
      <!-- /.row -->
      </div>
      <!-- /.row -->
    </section>

  </div>
  <!-- /.content-wrapper -->

<!-- /.content-wrapper -->
@endsection
@section('scripts')
<!-- DataTables -->
<script src="{{asset('dashboard/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('dashboard/plugins/datatables/dataTables.bootstrap.min.js')}}"></script>
<script src="https://unpkg.com/ionicons@5.5.2/dist/ionicons.js"></script>
<script src="{{asset('dashboard/plugins/datepicker/bootstrap-datepicker.js')}}"></script>
<script src="{{asset('dashboard/plugins/iCheck/icheck.min.js')}}"></script>
<!-- InputMask -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.2.6/jquery.inputmask.bundle.min.js"></script>
<script src="{{asset('dashboard/js/app.min.js')}}"></script>
<script src="{{asset('js/cuotas/create.js')}}"></script>
@endsection
