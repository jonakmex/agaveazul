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
        Cuotas
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{route('cuotas.index')}}">Cuotas</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Cuotas</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

                <table id="tblCuotas" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Nombre</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($cuotas as $cuota)
                      @if($cuota->periodicidad != null)
                      <tr>
                        <td><a href="{{route('cuotas.show',['id'=>$cuota->id])}}">{{$cuota->descripcion}}</a></td>
                        <td>
                          <a href="{{route('cuotas.edit',['id'=>$cuota->id])}}" class="btn btn-success"><i class="icon ion-md-create material-icons" data-toggle="tooltip" title="Editar"></i></a>
                          <a href="#delete{{$cuota->id}}" class="btn btn-danger" data-toggle="modal"><i class="icon ion-md-trash material-icons" data-toggle="tooltip" title="Eliminar"></i></a>
                        </td>
                      </tr>

                      <!-- Delete Modal HTML -->
                    	<div id="delete{{$cuota->id}}" class="modal fade">
                    		<div class="modal-dialog">
                    			<div class="modal-content">
                    				<form action="{{route('cuotas.destroy',['id'=>$cuota->id])}}" method="POST">
                              {{ csrf_field () }}
                              {{ method_field('DELETE') }}
                    					<div class="modal-header">
                    						<h4 class="modal-title">Eliminar Cuota <b>{{$cuota->descripcion}}</b></h4>
                    						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    					</div>
                    					<div class="modal-body">
                    						<p>Confirma que desea eliminar la cuenta {{$cuota->descripcion}}?</p>
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
                      @endif
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
    $("#tblCuotas").DataTable({
      "paging": false,
      "lengthChange": false,
      "searching": false,
      "ordering": false,
      "info": false,
      "autoWidth": false,
      "dom": '<"toolbar">frtip'
    });

    $("div.toolbar").html('<a href="{{route('cuotas.create')}}" class="edit"><i class="icon ion-md-add material-icons" title="Add"></i></a>');
  });
</script>
@endsection
