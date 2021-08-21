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
      Comunicados
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
              <h3 class="box-title">Comunicados</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table id="tblComunicados" class="table table-striped table-hover">
                  <thead>
                    <tr>
                      <th colspan="3"><a href="{{route('comunicados.create')}}" class="btn btn-sm btn-success"><ion-icon name="add"></ion-icon></a></th>
                    </tr>
                    <tr>
                      <th>Descripcion</th>
                      <th>Documento</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($comunicados as $comunicado)
                    <tr>
                      <td width="80%">{{ $comunicado->descripcion }}</td>
                      <td><a href="{{route('comunicados.getFile',['id'=>$comunicado->id])}}"><ion-icon name="document" title="Documento"></ion-icon></a></td>
                      <td>
                        <a href="{{route('comunicados.edit',['id'=>$comunicado->id])}}" class="edit" data-toggle="modal"><ion-icon  name="create" data-toggle="tooltip" title="Edit"></i></a>
                        <a href="#deleteComunicadoModal{{$comunicado->id}}" class="delete" data-toggle="modal"><ion-icon name="trash" data-toggle="tooltip" title="Delete"></i></a>
                      </td>
                    </tr>
                    @include('comunicados.modal.delete',['name'=>'deleteComunicadoModal'.$comunicado->id])
                    @endforeach
                  </tbody>
                </table>

      {{ $comunicados->links('_template.paginator', ['results' => $comunicados]) }}

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
<script src="https://unpkg.com/ionicons@5.5.2/dist/ionicons.js"></script>
<script src="{{asset('dashboard/js/app.min.js')}}"></script>
<script src="{{asset('js/comunicados/index.js')}}"></script>
@endsection
