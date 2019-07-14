@extends('_template.dashboard')

@section('title')
  <title>Create Comunicado</title>
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
      Editar Comunicado
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
            <div class="box-body">
                <form action="{{ route('comunicados.update',['id'=>$comunicado->id]) }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field () }}
                    {{ method_field('PUT') }}
                    <div class="form-group @php($err_descripcion = $errors->has('descripcion')?'has-error':'') {{$err_descripcion}}">
                        <label>Descripcion:</label>
                        <input id="descripcion" name="descripcion" value="{{$comunicado->descripcion}}" type="text" class="form-control">
                        @if ($errors->has('descripcion'))
                            <span class="help-block">{{ $errors->first('descripcion') }}</span>
                        @endif
                    </div>
                    <div class="form-group @php($err_documento = $errors->has('documento')?'has-error':'') {{$err_documento}}">
                        <label for="documento">Documento</label>
                        <input type="file" id="documento" name="documento">
                        @if ($errors->has('documento'))
                            <span class="help-block">{{ $errors->first('documento') }}</span>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <a href="{{route('comunicados.index')}}" class="btn btn-default" data-dismiss="modal" >Cancelar</a>
                        <button type="submit" class="btn btn-success enviar" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Procesando...">Guardar</button>
                    </div>
                </form>
            </div>
          </div>
        </div>
    </div>
</div> <!--content-wrapper-->
@endsection

@section('scripts')
<!-- DataTables -->
<script src="{{asset('dashboard/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('dashboard/plugins/datatables/dataTables.bootstrap.min.js')}}"></script>
<script src="https://unpkg.com/ionicons@4.4.4/dist/ionicons.js"></script>
<script src="{{asset('dashboard/js/app.min.js')}}"></script>
<script src="{{asset('js/comunicados/create.js')}}"></script>
@endsection