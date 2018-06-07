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
@endsection
@section('content')


    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Viviendas
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Viviendas</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="col-sm-6">
                <a href="{{route('vivienda.create')}}" class="btn btn-flat"><span>Nuevo</span></a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

                <table id="tblViviendas" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>
                        <span class="custom-checkbox">
                          <input type="checkbox" id="selectAll">
                          <label for="selectAll"></label>
                        </span>
                      </th>
                      <th>Descripcion</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach($viviendas as $vivienda)
                    <tr>
                      <td width="10%">
                        <span class="custom-checkbox">
                        <input type="checkbox" id="checkbox{{ $vivienda->id }}" name="options[]" value="1">
                        <label for="checkbox1"></label>
                        </span>
                      </td>
                      <td><a href="{{route('vivienda.show',['id'=>$vivienda->id])}}">{{ $vivienda->descripcion }}</a></td>
                      <td >
                        <a href="{{route('vivienda.edit',['id'=>$vivienda->id])}}" class="btn btn-success"><i class="icon ion-md-create material-icons" data-toggle="tooltip" title="Editar"></i></a>
                        <a href="#delete{{$vivienda->id}}" class="btn btn-danger" data-toggle="modal"><i class="icon ion-md-trash material-icons" data-toggle="tooltip" title="Eliminar"></i></a>
                      </td>
                    </tr>
                    <!-- Delete Modal HTML -->
                    <div id="delete{{$vivienda->id}}" class="modal fade">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <form action="{{route('vivienda.destroy',['id'=>$vivienda->id])}}" method="POST">
                            {{ csrf_field () }}
                            {{ method_field('DELETE') }}
                            <div class="modal-header">
                              <h4 class="modal-title">Eliminar Vivienda <b>{{$vivienda->descripcion}}</b></h4>
                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                            <div class="modal-body">
                              <p>Confirma que desea eliminar la {{$vivienda->descripcion}}?</p>
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
    $("#tblViviendas").DataTable({
      "paging": false,
      "lengthChange": false,
      "searching": false,
      "ordering": false,
      "info": false,
      "autoWidth": false,
      "dom": '<"toolbar">frtip'
    });

    $("div.toolbar").html('<a href="{{route('vivienda.create')}}" class="edit"><i class="icon ion-md-add material-icons" title="Add"></i></a>');
  });
</script>
@endsection
