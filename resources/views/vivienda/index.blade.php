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
      Directorio del Residencial
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
      <li class="active">Here</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Viviendas</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table id="tblViviendas" class="table table-striped table-hover">
                  <thead>
                    <tr>
                      <th>Descripcion</th>
                      <th>Clave</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($viviendas as $vivienda)
                    <tr>
                      <td><a href="{{route('vivienda.show',['id'=>$vivienda->id])}}">{{ $vivienda->descripcion }}</a></td>
                      <td>{{ $vivienda->clave }}</td>
                      <td>
                        <a href="#editEmployeeModal{{$vivienda->id}}" class="edit" data-toggle="modal"><ion-icon  name="create" data-toggle="tooltip" title="Edit"></i></a>
                        <a href="#deleteEmployeeModal{{$vivienda->id}}" class="delete" data-toggle="modal"><ion-icon name="trash" data-toggle="tooltip" title="Delete"></i></a>
                      </td>
                    </tr>
                    @include('vivienda.modal.edit',['name'=>'editEmployeeModal'.$vivienda->id])
                    @include('vivienda.modal.delete',['name'=>'deleteEmployeeModal'.$vivienda->id])
                    @endforeach
                  </tbody>
                </table>

      {{ $viviendas->links('_template.paginator', ['results' => $viviendas]) }}

  </div>
  </div>
             <!-- /.box-body -->
           </div>
           <!-- /.box -->
         </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
@include('vivienda.modal.add',['name'=>'addEmployeeModal'])
<!-- /.content-wrapper -->
@endsection
@section('scripts')
<!-- DataTables -->
<script src="{{asset('dashboard/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('dashboard/plugins/datatables/dataTables.bootstrap.min.js')}}"></script>
<script src="https://unpkg.com/ionicons@4.4.4/dist/ionicons.js"></script>
<script src="{{asset('dashboard/js/app.min.js')}}"></script>
<script src="{{asset('js/vivienda/index.js')}}"></script>
@endsection
