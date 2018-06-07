@extends('common.user')
@section('styles')
<style>
.toolbar {
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
<!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="{{asset('dashboard/plugins/iCheck/all.css')}}">
@endsection
@section('content')

<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        {{$vivienda->descripcion}}
        <small>Detalle</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Residencial</a></li>
        <li><a href="{{route('vivienda.index')}}">Viviendas</a></li>
        <li class="active">{{$vivienda->descripcion}}</li>
      </ol>
    </section>

		<!-- Main content -->
    <section class="content">
			<div class="row">
        <div class="col-md-12">
          <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#home">Contactos</a></li>
            <li><a data-toggle="tab" href="#menu1">Cuotas</a></li>
          </ul>

          <div class="tab-content">
            <div id="home" class="tab-pane fade in active">
              <div class="box box-danger">
                <div class="box-body">
    							<table id="tblContactos" class="table table-bordered table-striped">
    								<thead>
    									<tr>
    										<th>
    											<span class="custom-checkbox">
    												<input type="checkbox" id="selectAll">
    												<label for="selectAll"></label>
    											</span>
    										</th>
    										<th>Nombre</th>
    										<th>Email</th>
                        <th>Telefono</th>
    										<th>Acciones</th>
    									</tr>
    								</thead>
    								<tbody>
                      @foreach($vivienda->residentes()->where('estado', 1)->get() as $residente)
    									<tr>
    										<td width="10%">
    											<span class="custom-checkbox">
    											<input type="checkbox"  name="options[]" value="1">
    											<label for="checkbox1"></label>
    											</span>
    										</td>
    										<td><a href="{{route('residentes.show',['id'=>$residente->id])}}">{{$residente->nombre}}</a></td>
    										<td>{{$residente->email}}</td>
                        <td>{{$residente->telefono}}</td>
    										<td >
                          <a href="{{route('residentes.edit',['id'=>$residente->id])}}" class="btn btn-success"><i class="icon ion-md-create material-icons" data-toggle="tooltip" title="Editar"></i></a>
                          <a href="#delete{{$residente->id}}" class="btn btn-danger" data-toggle="modal"><i class="icon ion-md-trash material-icons" data-toggle="tooltip" title="Eliminar"></i></a>
    										</td>
    									</tr>

                      <!-- Delete Modal HTML -->
                    	<div id="delete{{$residente->id}}" class="modal fade">
                    		<div class="modal-dialog">
                    			<div class="modal-content">
                    				<form action="{{route('residentes.destroy',['id'=>$residente->id])}}" method="POST">
                              {{ csrf_field () }}
                              {{ method_field('DELETE') }}
                    					<div class="modal-header">
                    						<h4 class="modal-title">Eliminar Cuenta <b>{{$residente->nombre}}</b></h4>
                    						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    					</div>
                    					<div class="modal-body">
                    						<p>Confirma que desea eliminar la cuenta {{$residente->nombre}}?</p>
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
            </div>
            <div id="menu1" class="tab-pane fade">
              <div class="col-md-12">
                <div class="box box-primary">
                  <div class="box-header">
                    <h3 class="box-title">Saldo: $3,000</h3>
                  </div>
                  <div class="box-body">

      							<table class="table table-bordered table-hover">
      								<thead>
      									<tr>
      										<th>Cuota</th>
                          <th>Recibo</th>
      										<th>Limite</th>
      										<th>Pago</th>
      										<th>Importe</th>
      										<th>Estatus</th>
                          <th>Acciones</th>
      									</tr>
      								</thead>
      								<tbody>
      									<tr>
      										<td><a href="#">Anualidad</a></td>
                          <td><a href="#">2018</a></td>
      										<td>01/06/2018</td>
      										<td>01/06/2018</td>
      										<td>$1,000.00</td>
      										<td><i class="icon ion-md-checkmark material-icons" title="Pagado"></i></td>
                          <td><a href="#" class="edit"></a></td>
      									</tr>
                        <tr>
      										<td><a href="#">Mensualidad</a></td>
                          <td><a href="#">ENERO 2018</a></td>
      										<td>01/06/2018</td>
      										<td></td>
      										<td>$550.00</td>
      										<td><i class="icon ion-md-close material-icons" title="Pagado"></i></td>
                          <td><a href="#" class="edit"><i class="icon ion-md-card material-icons" title="Pagado"></i></a></td>
      									</tr>
      								</tbody>
      							</table>
                  </div>
                  <!-- /.box-body -->
                </div>
                <!-- /.box -->
              </div>
            </div>
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col (left) -->
        <!-- /.col (right) -->
      </div>
      <!-- /.row -->
	  </section>

@endsection

@section('scripts')
<script src="https://unpkg.com/ionicons@4.1.2/dist/ionicons.js"></script>
<!-- Select2 -->
<script src="{{asset('dashboard/plugins/select2/select2.full.min.js')}}"></script>
<!-- iCheck 1.0.1 -->
<script src="{{asset('dashboard/plugins/iCheck/icheck.min.js')}}"></script>
<script src="{{asset('dashboard/plugins/datatables/jquery.dataTables.min.js')}}"></script>

<script >
$(function () {
    //Initialize Select2 Elements
    $(".select2").select2();

		//iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue'
    });
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass: 'iradio_minimal-red'
    });
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass: 'iradio_flat-green'
    });

    $("#tblContactos").DataTable({
      "paging": false,
      "lengthChange": false,
      "searching": false,
      "ordering": false,
      "info": false,
      "autoWidth": false,
      "dom": '<"toolbar">frtip'
    });

    $("div.toolbar").html('<a href="{{route('crearResidente',$vivienda->id) }}" class="edit"><i class="icon ion-md-add material-icons" title="Add"></i></a>');
  });
</script>
@endsection
