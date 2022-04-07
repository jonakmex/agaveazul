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
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="{{asset('dashboard/plugins/timepicker/bootstrap-timepicker.min.css')}}">
@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Estado de Cuenta {{$vivienda->descripcion}} 
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">User profile</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-6">

            <table id="tblRecibos" class="table table-striped table-hover">
                <thead>
                  <tr>
                    <th>Cuota</th>
                    <th>Recibo</th>
                    <th>Limite</th>
                    <th>Importe</th>
                  </tr>
                </thead>
                <tbody>

                  @foreach($recibos as $recibo)
                  <tr>
                    <td>
                    @if($recibo->reciboheader != null)
                        {{$recibo->reciboheader->cuota->descripcion}}
                    @endif
                    </td>
                    <td>{{$recibo->descripcion}}</td>
                    <td>{{$recibo->fecLimite}}</td>
                    <td>
                        ${{$recibo->importe}}
                    </td>
                  </tr>
                  @endforeach
                  <tr>
                    <td colspan="3" align="right">
                        <b>Total:</b>
                    </td>
                    <td><b>${{$total}}</b></td>
                  </tr>
                </tbody>
              </table>
          
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
<script src="{{asset('dashboard/plugins/datepicker/bootstrap-datepicker.js')}}"></script>
<script src="{{asset('dashboard/plugins/iCheck/icheck.min.js')}}"></script>
<!-- InputMask -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.2.6/jquery.inputmask.bundle.min.js"></script>
<!-- bootstrap time picker -->
<script src="{{asset('dashboard/plugins/timepicker/bootstrap-timepicker.min.js')}}"></script>

<script src="{{asset('dashboard/js/app.min.js')}}"></script>


@endsection
