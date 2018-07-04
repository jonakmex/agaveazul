@extends('common.user')
@section('styles')
<style>
.toolbar {
    float: right;
}
.toolbar_mov {
    float: right;
}
.table-title .btn-group {
		float: right;
	}
	.table-title .btn {
		color: #fff;
		float: right;
		font-size: 13px;
		border: none;
		min-width: 50px;
		border-radius: 2px;
		border: none;
		outline: none !important;
		margin-left: 10px;
	}
	.table-title .btn i {
		float: left;
		font-size: 21px;
		margin-right: 5px;
	}
	.table-title .btn span {
		float: left;
		margin-top: 2px;
	}
</style>
@endsection
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Cuentas
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Cuentas</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
        <div class="col-xs-4">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Cuentas</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="tblCuentas" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Nombre</th>
                      <th>Saldo</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($cuentas as $cuenta)
                    <tr>
                      <td><a href="{{route('cuentas.show',['id'=>$cuenta->id])}}">{{$cuenta->descripcion}}</a></td>
                      <td>${{ number_format($cuenta->saldo, 2, ',', '.')}}</td>
                      <td>
                        <a href="{{route('cuentas.edit',['id'=>$cuenta->id])}}" class="btn btn-success"><i class="icon ion-md-create material-icons" data-toggle="tooltip" title="Editar"></i></a>
                        <a href="#delete{{$cuenta->id}}" class="btn btn-danger" data-toggle="modal"><i class="icon ion-md-trash material-icons" data-toggle="tooltip" title="Eliminar"></i></a>
                      </td>
                    </tr>

                    <!-- Delete Modal HTML -->
                  	<div id="delete{{$cuenta->id}}" class="modal fade">
                  		<div class="modal-dialog">
                  			<div class="modal-content">
                  				<form action="{{route('cuentas.destroy',['id'=>$cuenta->id])}}" method="POST">
                            {{ csrf_field () }}
                            {{ method_field('DELETE') }}
                  					<div class="modal-header">
                  						<h4 class="modal-title">Eliminar Cuenta <b>{{$cuenta->descripcion}}</b></h4>
                  						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  					</div>
                  					<div class="modal-body">
                  						<p>Confirma que desea eliminar la cuenta {{$cuenta->descripcion}}?</p>
                  						<p class="text-warning"><small>Esta accion no puede deshacerse.</small></p>
                  					</div>
                  					<div class="modal-footer">
                  						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                  						<input type="submit" class="btn btn-danger" value="Delete">
                  					</div>
                  				</form>
                  			</div>
                  		</div>
                  	</div>
                    @endforeach
                  </tbody>
                </table>
               </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
             <!-- /.box -->
        </div>
        <!-- /.col -->
        <!-- /.col (left) -->
        <div class="col-md-8">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Estado de Cuenta <b>{{$selected->descripcion}}</b></h3>
            </div>
            <div class="box-body">
              <table id="tblMovimientos" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>Nombre</th>
                    <th>Ingreso</th>
                    <th>Egreso</th>
                    <th>Saldo</th>
                    <th>Fecha</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($movimientos as $movimiento)
                  <tr>
                    <td>
                      @if($movimiento->comprobante != null)
                        <a href="{{asset($movimiento->comprobante)}}" class="edit" target="_blank">{{$movimiento->descripcion}}</a>
                      @else
                        {{$movimiento->descripcion}}
                      @endif
                    </td>
                    <td>
                      @if($movimiento->ingreso != null)
                        ${{$movimiento->ingreso}}
                      @endif
                    </td>
                    <td>
                      @if($movimiento->egreso != null)
                        ${{$movimiento->egreso}}
                      @endif
                    </td>
                    <td>${{$movimiento->saldo}}</td>
                    <td>
                      {{$movimiento->fecMov}}
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>

            <!-- /.box-body -->
            {!! $movimientos->appends(request()->input())->links() !!}

            <!-- Delete Modal HTML -->
            <div id="report" class="modal fade">
              <div class="modal-dialog">
                <div class="modal-content">
                  <form action="{{route('estadoCta.exportar')}}" method="POST">
                    {{ csrf_field () }}
                    <div class="modal-header">
                      <h4 class="modal-title">Seleccione periodo</b></h4>
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <input type="hidden" name="id" value="{{$selected->id}}"/>
                    <div class="modal-body">
                      <div class="col-md-6">
                        <div class="form-group @php($err_fecInicio = $errors->has('fecInicio')?'has-error':'') {{$err_fecInicio}}" >
                          <label for="fecInicio">Fecha Inicial</label>
                          <div class="input-group date">
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text"  name="fecInicio" id="fecInicio" class="form-control"/ required>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group @php($err_fecFin = $errors->has('fecFin')?'has-error':'') {{$err_fecFin}}" >
                          <label for="fecFin">Fecha Final</label>
                          <div class="input-group date">
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text"  name="fecFin" id="fecFin" class="form-control"/ required>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                      <input type="submit" class="btn btn-primary" value="Enviar">
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          </div>
          <!-- /.box -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
@endsection

@section('scripts')
<script src="{{asset('dashboard/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('dashboard/plugins/datatables/dataTables.bootstrap.min.js')}}"></script>
<script src="{{asset('dashboard/plugins/datepicker/bootstrap-datepicker.js')}}"></script>
<script>
  $(function () {
    $("#tblCuentas").DataTable({
      "paging": false,
      "lengthChange": false,
      "searching": false,
      "ordering": false,
      "info": false,
      "autoWidth": false,
      "dom": '<"toolbar">frtip'
    });

    $("div.toolbar").html('<a href="{{route('cuentas.create')}}" class="edit"><i class="icon ion-md-add material-icons" title="Add"></i></a>');

    //Tabla Movimientos '<"toolbar_mov">frtip'
    $("#tblMovimientos").DataTable({
      "paging": false,
      "lengthChange": false,
      "searching": false,
      "ordering": false,
      "info": false,
      "autoWidth": false,
      "dom": '<"toolbar_mov">frtip',
      buttons: [
        'excel'
      ]
    });

    $("div.toolbar_mov").html('<a href="{{route('movimientos.create',['cuenta_id'=>$selected->id])}}" class="edit"><i class="icon ion-md-add material-icons" title="Add"></i></a>   <a href="#report" data-toggle="modal" class="edit"><i class="icon ion-md-download material-icons" title="Excel"></i></a>');

    $('#fecInicio').datepicker({
      autoclose: true,
      format: "yyyy-mm-dd"
    });

    $('#fecFin').datepicker({
      autoclose: true,
      format: "yyyy-mm-dd"
    });
  });
</script>
@endsection
