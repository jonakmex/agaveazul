@extends('_template.profiles.residente.dashboard')

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
        {{$vivienda->descripcion}}
      </h1>
      <ol class="breadcrumb">
        <li>La información se actualiza los días 12 de cada mes.</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <h3 class="profile-username text-center">{{$vivienda->descripcion}}</h3>
              <p class="text-muted text-center">Agave Azul V</p>
              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Saldo</b> <a class="pull-right">${{number_format($vivienda->saldo(), 2, '.', ',')}}</a>
                </li>
                <li class="list-group-item">
                  <b>Estatus</b> <a href="{{route('vivienda.edocta',['id'=>$vivienda->id])}}" class="pull-right"><span class="label label-{{$vivienda->estado() == 1 ? 'success':'danger' }}">{{$vivienda->estado() == 1 ? 'Corriente':'Mora' }}</span></a>
                </li>
                <li class="list-group-item">
                  <b>Referencia</b> <a class="pull-right">{{$vivienda->referencia}}</a>
                </li>
              </ul>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <div class="box box-primary">
            <div class="box-body box-profile">
              <h3 class="profile-username text-center">Información</h3>
              <p class="text-muted text-center">Referencias de pago</p>
              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Banco</b> <a class="pull-right">Scotiabank</a>
                </li>
                <li class="list-group-item">
                  <b>Cuenta</b> <a class="pull-right">25600009260</a>
                </li>
                <li class="list-group-item">
                  <b>CLABE</b> <a class="pull-right">044685256000092609</a>
                </li>
                <li class="list-group-item">
                  <b>Beneficiario</b> <a class="pull-right">Agave Azul V A.C.</a>
                </li>
              </ul>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab">Recibos</a></li>
              <li><a href="#timeline" data-toggle="tab">Contactos</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane table-responsive" id="activity">
                <table id="tblRecibos" class="table table-striped table-hover">
                  <thead>
                    <tr>
                      <th>Cuota</th>
                      <th>Recibo</th>
                      <th>Limite</th>
                      <th>Pago</th>
                      <th>Importe</th>
                      <th>Estatus</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>

                    @foreach($recibos as $recibo)
                    <tr>
                      <td>
                      @if($recibo->reciboheader != null)
                        <a href="#">{{$recibo->reciboheader->cuota->descripcion}}</a>
                      @endif
                      </td>
                      <td><a href="#">{{$recibo->descripcion}}</a></td>
                      <td>{{$recibo->fecLimite}}</td>
                      <td>{{$recibo->fecPago}}</td>
                      <td>
                        @if($recibo->estado == 2)
                          ${{$recibo->saldo}}
                        @else
                          ${{$recibo->importe}}
                        @endif
                      </td>
                      <td>
                      @if($recibo->estado == 1)
                        <ion-icon name="calendar" title="Pendiente"></ion-icon>
                      @else
                        <ion-icon name="checkmark" title="Pagado"></ion-icon>
                      @endif
                      </td>
                      <td>
                        @if($recibo->estado != 1)
                          <a href="{{route('recibos.getPdf',['rec_id'=>$recibo->id])}}" target="_blank" ><ion-icon name="document" title="Recibo"></ion-icon></a>
                          @if($recibo->comprobante != null)
                            <a href="{{asset($recibo->comprobante)}}" target="_blank" ><ion-icon name="eye" title="Comprobante"></ion-icon></a>
                          @endif

                        @endif
                      </td>
                    </tr>

                    @endforeach

                  </tbody>
                </table>
                {{ $recibos->links('_template.paginator', ['results' => $recibos]) }}
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane table-responsive" id="timeline">
                <table id="tblContactos" class="table table-striped table-hover">
                  <thead>
                    <tr>
                      <th>Nombre</th>
                      <th>Email</th>
                      <th>Telefono</th>
                      <th>Tipo</th>
                      <th>Principal</th>
                    </tr>
                  </thead>
                  <tbody>

                    @foreach($vivienda->residentes()->where('estado', 1)->get() as $residente)
                    <tr>
                      <td width="30%">{{$residente->nombre}}</td>
                      <td width="20%">{{$residente->email}}</td>
                      <td width="20%">{{$residente->telefono}}</td>
                      <td width="20%">{{$residente->strTipo()}}</td>
                      <td>
                        @if($residente->principal == 1)
                          <ion-icon name="checkmark" title="Principal"></ion-icon>
                        @endif
                      </td>
                    </tr>
                  @endforeach


                  </tbody>
                </table>
                @include('contacto.modal.add',['name'=>'addModal'])
              </div>
              <!-- /.tab-pane -->


            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
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
