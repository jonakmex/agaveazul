@extends('common.user')

@section('content')


    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Residentes
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{route('residentes.index')}}">Residentes</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="col-sm-6">
                <a href="#" class="btn btn-flat"><span>Nuevo</span></a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

                <table class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>
                        <span class="custom-checkbox">
                          <input type="checkbox" id="selectAll">
                          <label for="selectAll"></label>
                        </span>
                      </th>
                      <th>Nombre</th>
                      <th>Vivienda</th>
                      <th>Telefono</th>
                      <th>Correo</th>
                      <th>Estado</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>

                    <tr>
                      <td width="10%">
                        <span class="custom-checkbox">
                        <input type="checkbox" id="" name="options[]" value="1">
                        <label for="checkbox1"></label>
                        </span>
                      </td>
                      <td><a href="#">Jonathan Gomez</a></td>
                      <td>Casa 10</td>
                      <td>5511566012</td>
                      <td>jonak@gmail.com</td>
                      <td>Activo</td>
                      <td width="10%">
                        <a href="#" class="edit"><i class="material-icons" data-toggle="tooltip" title="Editar">&#xE254;</i></a>
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
