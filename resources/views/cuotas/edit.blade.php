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
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
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
                  <div class="form-group">
      							<label for="clave">Clave</label>
      							 <input type="text" value="{{$cuota->clave}}"  name="clave" id="clave" class="form-control"/ required>
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


                  <!-- /.form group -->
                  <div class="form-group">

                      <span class="custom-checkbox">
                        <input id="chkRpt" type="checkbox" {{$cuota->periodicidad != null ? "checked" : ""}} class="flat-red" name="chkRpt"/>
                        <label for="chkRpt">Repetir</label>
                      </span>

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
                      @foreach($items as $vivienda)
                      <tr>
                        <td>
                          <span class="custom-checkbox">
            								<input type="checkbox" id="checkbox1" name="selected[]" {{$vivienda['checked']}}  value="{{$vivienda['vivienda']->id}}">
            								<label for="checkbox1"></label>
            							</span>
                        </td>
                        <td>{{$vivienda['vivienda']->descripcion}}</td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>

                </div>
    					</div>
            </div>
    					<div class="modal-footer">
                            <a href="{{route('cuotas.show',['id'=>$cuota->id])}}" class="btn btn-default">Cancelar</a>
    						<button type="submit" class="btn btn-success enviar" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Procesando...">Guardar</button>
    					</div>
    				</form>
          </div>
          </div>
          <!-- /.row -->
          </div>
          <!-- /.row -->
        </section>
        <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<!-- /.content-wrapper -->
@endsection
@section('scripts')
<!-- DataTables -->
<script src="{{asset('dashboard/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('dashboard/plugins/datatables/dataTables.bootstrap.min.js')}}"></script>
<script src="https://unpkg.com/ionicons@4.4.4/dist/ionicons.js"></script>
<script src="{{asset('dashboard/plugins/datepicker/bootstrap-datepicker.js')}}"></script>
<script src="{{asset('dashboard/plugins/iCheck/icheck.min.js')}}"></script>
<!-- InputMask -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.2.6/jquery.inputmask.bundle.min.js"></script>
<script src="{{asset('js/cuotas/edit.js')}}"></script>
@endsection
