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
      Documentos
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
              <h3 class="box-title">Lista de Documentos</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table id="tblDocumentos" class="table table-striped table-hover">
                  <thead>
                    <tr>
                      <th>Titulo</th>
                      <th>Archivo</th>
                      <th>Descripcion</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($documentos as $documento)
                    <tr>
                      <td>{{ $documento->titulo }}</a></td>
                      <td><a href="{{$documento->url()}}" download>{{ $documento->archivo }}</a></td>
                      <td>{{ $documento->descripcion }}</a></td>

                    </tr>

                    @endforeach
                  </tbody>
                </table>

      {{ $documentos->links('_template.paginator', ['results' => $documentos]) }}

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

<!-- /.content-wrapper -->
@endsection
@section('scripts')
<!-- DataTables -->
<script src="{{asset('dashboard/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('dashboard/plugins/datatables/dataTables.bootstrap.min.js')}}"></script>
<script src="https://unpkg.com/ionicons@4.4.4/dist/ionicons.js"></script>
<script src="{{asset('dashboard/js/app.min.js')}}"></script>
<script src="{{asset('js/profiles/residente/documento/index.js')}}"></script>
@endsection
