@extends('common.user')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Recibo Mensualidad / ENERO 2018
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Recibos</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Vivienda</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

                <table class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>Nombre</th>
                      <th>Importe</th>
                      <th>Ajuste</th>
                      <th>Total</th>
                      <th>Estado</th>
                      <th>Limite</th>
                      <th>Pago</th>
                      <th colspan="2">Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><a href="#">Casa 1</a></td>
                      <td>$500.00</td>
                      <td>$0.00</td>
                      <td>$500.00</td>
                      <td><i class="icon ion-md-checkmark material-icons" title="Pagado"></i></td>
                      <td>10/ENERO/2018</td>
                      <td>03/ENERO/2018</td>
                      <td width="10%">
                        <a href="#" class="edit"></a>
                      </td>
                      <td width="10%">
                        <a href="{{route('recibos.edit','id=1')}}" class="edit"><i class="icon ion-md-create material-icons" title="Editar"></i></a>
                      </td>
                    </tr>
                    <tr>
                      <td><a href="#">Casa 2</a></td>
                      <td>$500.00</td>
                      <td>$50.00</td>
                      <td>$550.00</td>
                      <td><i class="icon ion-md-close material-icons" title="Pendiente"></i></td>
                      <td>10/ENERO/2018</td>
                      <td></td>
                      <td width="10%">
                        <a href="{{route('pagos.create')}}" class="edit"><i class="icon ion-md-card material-icons" title="Pagar"></i></a>
                      </td>
                      <td width="10%">
                        <a href="{{route('recibos.edit','id=1')}}" class="edit"><i class="icon ion-md-create material-icons" title="Editar"></i></a>
                      </td>
                    </tr>
                  </tbody>
                </table>
                 </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
             <!-- /.box -->
        </div>
        <!-- /.col -->

      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
@endsection
