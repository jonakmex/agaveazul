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
    Viviendas
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{route('vivienda.index')}}">Viviendas</a></li>
  </ol>
</section>

		<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-body">
          <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#menu1">Cuotas</a></li>
            <li ><a data-toggle="tab" href="#home">Contactos</a></li>
          </ul>
          <div class="tab-content">
            <div id="menu1" class="tab-pane fade in active">
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
                  @foreach($recibos as $recibo)
                  <tr>
                    <td>
                    @if($recibo->reciboheader != null)
                      <a href="{{route('cuotas.show',['id'=>$recibo->reciboheader->cuota->id])}}">{{$recibo->reciboheader->cuota->descripcion}}</a>
                    @endif
                    </td>
                    <td><a href="{{route('recibosHeader.show',['id'=>$recibo->reciboheader])}}">{{$recibo->descripcion}}</a></td>
                    <td>{{$recibo->fecLimite}}</td>
                    <td>{{$recibo->fecPago}}</td>
                    <td>${{$recibo->importe}}</td>
                    <td>
                    @if($recibo->estado == 1)
                      <i class="icon ion-md-calendar material-icons" title="Pendiente">
                    @else
                      <i class="icon ion-md-checkmark material-icons" title="Pagado">
                    @endif
                    </td>
                    <td>
                      @if($recibo->estado == 1)
                        <a href="{{route('recibos.payAndBackToVivienda',['rec_id'=>$recibo->id])}}" class="edit"><i class="icon ion-md-card material-icons" title="Pagar"></i></a>
                      @else
                        <a href="{{asset($recibo->comprobante)}}" target="_blank" class="edit"><i class="icon ion-md-eye material-icons" title="Ver Recibo"></i></a>
                      @endif
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              {{ $recibos->links() }}
            </div>
            <div id="home" class="tab-pane fade">
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
                    <td>{{$residente->nombre}}</td>
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
          </div>
        </div>
      </div>
    </div>
  </div>
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
