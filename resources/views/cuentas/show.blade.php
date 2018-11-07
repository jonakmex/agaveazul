@extends('_template.dashboard')

@section('title')
  <title>Cuentas</title>
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

</script>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <section class="content-header">
      <h1>
        Cuentas
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
       <div class="col-md-4">
         <div class="box box-danger">
           <div class="box-header">
             <h3 class="box-title">
               Cuentas

           </div>
           <div class="box-body">
             <div class="table-responsive">
               <table id="tblCuentas" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Nombre</th>
                      <th>Saldo</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($cuentas as $cuenta)
                    <tr>
                      <td><a href="{{route('cuentas.show',['id'=>$cuenta->id])}}">{{$cuenta->descripcion}}</a></td>
                      <td width="10%">${{ number_format($cuenta->saldo, 2, ',', '.')}}</td>
                      <td width="20%">
                        <a href="#editModal{{$cuenta->id}}" class="edit" data-toggle="modal"><ion-icon name="create" data-toggle="tooltip" title="Editar"></i></a>
                        <a href="#deleteModal{{$cuenta->id}}" class="delete" data-toggle="modal"><ion-icon name="trash" data-toggle="tooltip" title="Eliminar"></i></a>
                      </td>
                    </tr>
                    @include('cuentas.modal.edit',['name'=>'editModal'.$cuenta->id])
                    @include('cuentas.modal.delete',['name'=>'deleteModal'.$cuenta->id])
                    @endforeach
                  </tbody>
                </table>
             </div>
           </div>
           <!-- /.box-body -->
         </div>
         <!-- /.box -->
       </div>
       <!-- /.col (left) -->
       <div class="col-md-8">
         <div class="box box-primary">
           <div class="box-header">
             <h3 class="box-title">Estado de Cuenta <b>{{$selected->descripcion}}</b></h3>
           </div>
           <div class="box-body">
             <div class="table-responsive">
             <table id="tblMovimientos" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Nombre</th>
                    <th>Ingreso</th>
                    <th>Egreso</th>
                    <th>Saldo</th>
                    <th>Fecha</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($movimientos as $movimiento)
                  <tr>
                    <td>
                      @if($movimiento->comprobante != null)
                        <a href="{{asset($movimiento->comprobante)}}" target="_blank">{{$movimiento->descripcion}}</a>
                      @else
                        {{$movimiento->descripcion}}
                      @endif
                    </td>
                    <td width="10%">
                      @if($movimiento->ingreso != null)
                        ${{$movimiento->ingreso}}
                      @endif
                    </td>
                    <td width="10%">
                      @if($movimiento->egreso != null)
                        ${{$movimiento->egreso}}
                      @endif
                    </td>
                    <td width="10%">${{$movimiento->saldo}}</td>
                    <td>
                      {{$movimiento->fecMov}}
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
              <!-- /.box-body -->
              {!! $movimientos->appends(request()->input())->links() !!}
           </div>
           <!-- /.box-body -->
         </div>
         <!-- /.box -->
       </div>

     </div>
     <!-- /.row -->
   </section>
   <!-- /.content -->
   @include('cuentas.modal.add',['name'=>'addModal'])
   @include('cuentas.modal.export',['name'=>'exportModal'])
   @include('movimientos.modal.add',['name'=>'addMovModal','cuenta'=>$selected])

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
<script src="{{asset('dashboard/plugins/timepicker/bootstrap-timepicker.min.js')}}"></script>
<script src="{{asset('dashboard/js/app.min.js')}}"></script>
<script src="{{asset('js/cuentas/show.js')}}"></script>
@endsection
