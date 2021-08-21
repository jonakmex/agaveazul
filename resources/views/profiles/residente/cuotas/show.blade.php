@extends('_template.profiles.residente.dashboard')

@section('title')
  <title>Cuotas</title>
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
        Cuotas
        <small>Crear</small>
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
                   </tr>
                 </thead>
                 <tbody>
                   @foreach($cuotas as $cuota)
                   <tr>
                     <td><a href="{{route('cuotas.show',['id'=>$cuota->id])}}">{{$cuota->descripcion}}</a></td>
                   </tr>
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
                    <th>Total</th>
                    <th>Importe</th>
                    <th>Estado</th>
                  </tr>
                </thead>
                <tbody>
                  @php($headers = $selected->recibosHeader()->orderBy('id','desc')->paginate(10))
                  @foreach($headers as $header)
                  <tr>
                    <td>{{$header->descripcion}}</td>
                    <td width="10%">${{number_format($header->total(), 2, '.', ',')}}</td>
                    <td width="10%">${{number_format($header->cobrado(), 2, '.', ',')}}</td>
                    <td>
                      <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: {{$header->estado()}}%;" aria-valuenow="{{$header->estado()}}" aria-valuemin="0" aria-valuemax="100">{{$header->estado()}}%</div>
                      </div>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              {{ $headers->links() }}
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

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
<script src="{{asset('dashboard/js/app.min.js')}}"></script>
@endsection
