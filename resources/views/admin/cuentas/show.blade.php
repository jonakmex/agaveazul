@extends('common.user')
@section('styles')
<style>
.toolbar {
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
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{route('cuentas.index')}}">Cuentas</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
        <div class="col-xs-6">
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
        <div class="col-md-6">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Estado de Cuenta <b>{{$selected->descripcion}}</b></h3>
            </div>
            <div class="box-body">
              <table class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>Nombre</th>
                    <th>Ingreso</th>
                    <th>Egreso</th>
                    <th>Saldo</th>
                    <th colspan="2">Accion</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><a href="{{route('recibos.show','id=1')}}">Jardinería</a></td>
                    <td></td>
                    <td>$30,000.00</td>
                    <td>$30,000.00</td>
                    <td><a href="#" class="edit"><i class="icon ion-md-create material-icons" title="Editar"></i></a></td>
                    <td><a href="#" class="edit"><i class="icon ion-md-trash material-icons" title="Eliminar"></i></a></td>
                  </tr>
                  <tr>
                    <td><a href="{{route('recibos.show','id=1')}}">Mensualidad/Casa 10</a></td>
                    <td>$500.00</td>
                    <td></td>
                    <td>$30,000.00</td>
                    <td><a href="#" class="edit"><i class="icon ion-md-create material-icons" title="Editar"></i></a></td>
                    <td><a href="#" class="edit"><i class="icon ion-md-trash material-icons" title="Eliminar"></i></a></td>
                  </tr>
                  <tr>
                    <td><a href="{{route('recibos.show','id=1')}}">Mensualidad/Casa 10</a></td>
                    <td>$500.00</td>
                    <td>$30,000.00</td>
                    <td>$30,000.00</td>
                    <td><a href="#" class="edit"><i class="icon ion-md-create material-icons" title="Editar"></i></a></td>
                    <td><a href="#" class="edit"><i class="icon ion-md-trash material-icons" title="Eliminar"></i></a></td>
                  </tr>
                  <tr>
                    <td><a href="{{route('recibos.show','id=1')}}">Mensualidad/Casa 10</a></td>
                    <td>$500.00</td>
                    <td></td>
                    <td>$30,000.00</td>
                    <td><a href="#" class="edit"><i class="icon ion-md-create material-icons" title="Editar"></i></a></td>
                    <td><a href="#" class="edit"><i class="icon ion-md-trash material-icons" title="Eliminar"></i></a></td>
                  </tr>
                  <tr>
                    <td><a href="{{route('recibos.show','id=1')}}">Mensualidad/Casa 10</a></td>
                    <td>$500.00</td>
                    <td></td>
                    <td>$30,000.00</td>
                    <td><a href="#" class="edit"><i class="icon ion-md-create material-icons" title="Editar"></i></a></td>
                    <td><a href="#" class="edit"><i class="icon ion-md-trash material-icons" title="Eliminar"></i></a></td>
                  </tr>
                  <tr>
                    <td><a href="{{route('recibos.show','id=1')}}">Mensualidad/Casa 10</a></td>
                    <td></td>
                    <td>$30,000.00</td>
                    <td>$30,000.00</td>
                    <td><a href="#" class="edit"><i class="icon ion-md-create material-icons" title="Editar"></i></a></td>
                    <td><a href="#" class="edit"><i class="icon ion-md-trash material-icons" title="Eliminar"></i></a></td>
                  </tr>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
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
  });
</script>
@endsection
