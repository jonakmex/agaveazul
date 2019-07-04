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
<script type="text/javascript">
	 	var createUrl = "{{ route('cuotas.create')}}";
</script>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <section class="content-header">
      <h1>
        Finanzas
        <small>Programar Cuotas</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Forms</a></li>
        <li class="active">Advanced Elements</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-6">
          <div class="box box-danger">
            <div class="box-header">
              <h3 class="box-title">Cuotas</h3>
            </div>
            <div class="box-body">
              <div class="table-responsive">
                <table id="tblCuotas" class="table table-striped table-hover">
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
                      <td width="20%">
                        <a href="{{route('cuotas.edit',['id'=>$cuota->id])}}" class="edit"><ion-icon name="create" data-toggle="tooltip" title="Editar"></ion-icon></a>
                        <a href="#deleteModal{{$cuota->id}}" class="delete" data-toggle="modal"><ion-icon name="trash" data-toggle="tooltip" title="Eliminar"></ion-icon></a>
                      </td>
                    </tr>
                    @include('cuotas.modal.delete',['name'=>'deleteModal'.$cuota->id])
                    @endforeach
                  </tbody>
                </table>
                {{ $cuotas->links('_template.paginator', ['results' => $cuotas]) }}
                </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col (left) -->

      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<!-- /.content-wrapper -->
@include('cuotas.modal.search',['name'=>'searchCuotaModal'])
@endsection
@section('scripts')
<!-- DataTables -->
<script src="{{asset('dashboard/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('dashboard/plugins/datatables/dataTables.bootstrap.min.js')}}"></script>
<script src="https://unpkg.com/ionicons@4.4.4/dist/ionicons.js"></script>
<script src="{{asset('dashboard/js/app.min.js')}}"></script>
<script src="{{asset('js/cuotas/index.js')}}"></script>
@endsection
