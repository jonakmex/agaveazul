@extends('_template.dashboard')
@section('styles')
  <link href="{{asset('css/custom-checkbox.css')}}" rel="stylesheet">
  <link href="{{asset('css/custom-table.css')}}" rel="stylesheet">
  <link href="{{asset('css/custom-modal.css')}}" rel="stylesheet">
  <link href="{{asset('css/custom-pagination.css')}}" rel="stylesheet">
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Diario de Bancos
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

              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <div class="table-responsive">
                  
                    <form action="{{ route('diariobanco.store') }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field () }}
                        <input type="file" id="diariobanco" name="diariobanco">
                        <label for="fecha">Fecha</label><br/>
                        <input type="text" id="fecha" value="{{$fecha}}" name="fecha">
                        <br/>
                        <br/>
                        <br/>
                        <button type="submit">Extraer</button>
                    </form>

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
@endsection
@section('scripts')
<!-- DataTables -->
<script src="https://unpkg.com/ionicons@5.5.2/dist/ionicons.js"></script>

@endsection
