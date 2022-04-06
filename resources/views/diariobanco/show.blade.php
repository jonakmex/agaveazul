@extends('_template.dashboard')

@section('title')
  <title>Comunicado</title>
@endsection

@section('styles')
  <link href="{{asset('css/custom-checkbox.css')}}" rel="stylesheet">
  <link href="{{asset('css/custom-table.css')}}" rel="stylesheet">
  <link href="{{asset('css/custom-modal.css')}}" rel="stylesheet">
  <link href="{{asset('css/custom-pagination.css')}}" rel="stylesheet">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('dashboard/plugins/datatables/dataTables.bootstrap.css')}}">
  <!-- bootstrap wysihtml5 - text editor -->
<link rel="stylesheet" href="{{asset('dashboard/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">
@endsection

@section('content')
<script type="text/javascript">

</script>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <section class="content-header">
      <h1>
        Aplicar Transacciones
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Forms</a></li>
        <li class="active">Advanced Elements</li>
      </ol>
    </section>

    <!-- Main content -->
   <section class="content">
     <form action="{{route('diariobanco.apply')}}" method="POST" enctype="multipart/form-data">
       {{ csrf_field () }}
       <input type="hidden" id="fechaInicio" value="{{$fechaInicio}}" name="fechaInicio">
       <input type="hidden" id="fechaFin" value="{{$fechaFin}}" name="fechaFin">
        <table class="table table-bordered table-stripped table-hover">
            <tr>
                <thead>
                <th>Leyenda</th>
                <th width="60px">Transaccion</th>
                <th>Tipo</th>
                <th>Fecha</th>
                <th>Importe</th>
                <th>Saldo</th>
                <th>Casa</th>
                <th>Status</th>
                </thead>
            </tr>
            @foreach ($records as $record)
                <tr>
                    <td>{{$record["diario"]->leyenda_1}}</td>
                    <td>{{$record["diario"]->informacion_adicional_spei}}</td>
                    <td>{{$record["diario"]->tipo_transaccion}}</td>
                    <td>{{$record["diario"]->fecha}}</td>
                    <td>$@currency($record["diario"]->importe)</td>
                    <td>${{$record["diario"]->saldo}}</td>
                    @if($record["vivienda"] != null)
                        <td>{{$record["vivienda"]->descripcion}}</td>
                    @else
                        <td></td>
                    @endif
                    @if($record["diario"]->estado == 0)
                        <td style="color:red">Nuevo</td>
                    @else
                        <td style="color:green">Aplicado</td>
                    @endif
                    <td>
                        <span class="custom-checkbox">
                          <input type="checkbox" id="checkbox1" name="selected[]" {{$record['checked']}} value="{{$record["diario"]->id}}">
                          <label for="checkbox1"></label>
                        </span>
                      </td>
                </tr>
            @endforeach
        </table>
        <button id="btnEnviar" type="submit" class="btn btn-primary enviar" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Procesando...">Aplicar</button>
        <a href="{{route('diariobanco.index')}}">Inicio</a>
   </form>
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
<script src="{{asset('dashboard/plugins/datepicker/bootstrap-datepicker.js')}}"></script>
<script src="{{asset('dashboard/plugins/iCheck/icheck.min.js')}}"></script>
<!-- InputMask -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.2.6/jquery.inputmask.bundle.min.js"></script>
<script src="{{asset('dashboard/js/app.min.js')}}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{asset('dashboard/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
<script src="{{asset('js/comunicado/index.js')}}"></script>

@endsection
