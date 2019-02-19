@extends('_template.dashboard')

@section('title')
  <title>Recibos</title>
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
<script type="text/javascript">
	 	var exportUrl = "{{route('recibosHeader.exportar',['id'=>$reciboHeader->id])}}";

</script>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <section class="content-header">
      <h1>
        Recibos
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
       <div class="col-md-12">
         <div class="box box-danger">
           <div class="box-header">
             <h3 class="box-title">
               @if($reciboHeader != null)
                  <a href="{{route('cuotas.show',['id'=>$reciboHeader->cuota->id])}}">{{$reciboHeader->cuota->descripcion}}</a> > {{$reciboHeader->descripcion}}
               @endif

           </div>
           <div class="box-body">
             <div class="table-responsive">
               <table id="tblHeader" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Vivienda</th>
                      <th>Importe</th>
                      <th>Ajuste</th>
                      <th>Total</th>
                      <th>Estado</th>
                      <th>Limite</th>
                      <th>Pago</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if($reciboHeader != null)
                      @php($recibos = $reciboHeader->recibos()->orderBy('vivienda_id')->paginate(10))
                      @foreach($recibos as $rec)
                      <tr>
                        <td>{{$rec->vivienda->descripcion}}</td>
                        <td>${{number_format($rec->importe, 2, '.', ',')}}</td>
                        <td>${{number_format($rec->ajuste, 2, '.', ',')}}</td>
                        <td>${{number_format($rec->importe+$rec->ajuste, 2, '.', ',')}}</td>
                        <td>
                            @if($rec->estado == 1)
                              <ion-icon name="calendar" title="Pendiente"></ion-icon>
                            @elseif($rec->estado == 2)
                              <ion-icon name="checkmark" title="Pagado"></ion-icon>
                            @elseif($rec->estado == 3)
                              <ion-icon name="warning" title="Retraso"></ion-icon>
                            @endif
                        </td>
                        <td>{{$rec->fecLimite}}</td>
                        <td>{{$rec->fecPago}}</td>
                        <td>
                          @if($rec->estado == 1)
                            <a href="#payModal{{$rec->id}}" data-toggle="modal"><ion-icon name="card" title="Pagar"></ion-icon></a>
                          @elseif($rec->estado == 2)
                            <a href="{{route('recibos.getPdf',['rec_id'=>$rec->id])}}" target="_blank" ><ion-icon name="document" title="Recibo"></ion-icon></a>
                            @if($rec->comprobante != null)
                              <a href="{{asset($rec->comprobante)}}" target="_blank"><ion-icon name="eye" title="Comprobante"></ion-icon></a>
                            @endif
                          @elseif($rec->estado == 3)
                            @if($rec->comprobante != null)
                              <a href="{{asset($rec->comprobante)}}" class="edit"><ion-icon name="card" title="Pagar"></ion-icon></a>
                            @endif
                          @endif
                        </td>
                      </tr>
                      @include('recibos.modal.pay',['name'=>'payModal'.$rec->id,'recibo'=>$rec,'cuentas'=>$cuentas,'origen'=>'recibos','_id'=>$reciboHeader->id])
                      @endforeach
                    @endif
                  </tbody>
                </table>
                {{$recibos->links()}}
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
@endsection
@section('scripts')
<!-- DataTables -->
<script src="{{asset('dashboard/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('dashboard/plugins/datatables/dataTables.bootstrap.min.js')}}"></script>
<script src="https://unpkg.com/ionicons@4.4.4/dist/ionicons.js"></script>
<script src="{{asset('dashboard/plugins/datepicker/bootstrap-datepicker.js')}}"></script>
<script src="{{asset('dashboard/plugins/iCheck/icheck.min.js')}}"></script>
<!-- InputMask -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.2.6/jquery.inputmask.bundle.min.js"></script>
<!-- bootstrap time picker -->
<script src="{{asset('dashboard/plugins/timepicker/bootstrap-timepicker.min.js')}}"></script>

<script src="{{asset('dashboard/js/app.min.js')}}"></script>
<script src="{{asset('js/recibos/header/show.js')}}"></script>
@endsection
