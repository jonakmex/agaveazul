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
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Cuotas</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
        <div class="col-xs-6">
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
                    <tr>
                      <td><a href="{{route('cuotas.show',['id'=>$cuota->id])}}">{{$cuota->descripcion}}</a></td>
                      <td>
                        <a href="{{route('cuotas.edit',['id'=>$cuota->id])}}" class="btn btn-success"><i class="icon ion-md-create material-icons" data-toggle="tooltip" title="Editar"></i></a>
                        <a href="#" class="btn btn-danger" data-toggle="modal"><i class="icon ion-md-trash material-icons" data-toggle="tooltip" title="Eliminar"></i></a>
                      </td>
                    </tr>
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
              <h3 class="box-title">Recibos de <b>{{$selected->descripcion}}</b></h3>
            </div>
            <div class="box-body">
              <table class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>Nombre</th>
                    <th>Importe</th>
                    <th>Recaudacion</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><a href="{{route('recibos.show','id=1')}}">ENERO 2018</a></td>
                    <td>$500.00</td>
                    <td>$30,000.00</td>
                  </tr>
                  <tr>
                    <td><a href="{{route('recibos.show','id=1')}}">FEBRERO 2018</a></td>
                    <td>$500.00</td>
                    <td>$30,000.00</td>
                  </tr>
                  <tr>
                    <td><a href="{{route('recibos.show','id=1')}}">MARZO 2018</a></td>
                    <td>$500.00</td>
                    <td>$30,000.00</td>
                  </tr>
                  <tr>
                    <td><a href="{{route('recibos.show','id=1')}}">ABRIL 2018</a></td>
                    <td>$500.00</td>
                    <td>$30,000.00</td>
                  </tr>
                  <tr>
                    <td><a href="{{route('recibos.show','id=1')}}">MAYO 2018</a></td>
                    <td>$500.00</td>
                    <td>$30,000.00</td>
                  </tr>
                  <tr>
                    <td><a href="{{route('recibos.show','id=1')}}">JUNIO 2018</a></td>
                    <td>$500.00</td>
                    <td>$30,000.00</td>
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
