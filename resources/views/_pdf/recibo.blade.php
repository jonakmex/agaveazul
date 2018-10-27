<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Invoice</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="{{public_path('dashboard/bootstrap/css/bootstrap.min.css')}} type="text/css" ">

  <!-- Theme style -->
  <link rel="stylesheet" href="{{public_path('dashboard/css/AdminLTE.min.css')}}" type="text/css" >

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  
</head>
<body>
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header" >
          <img class="header" src="{{public_path('img/residencial-el-agave-azul.png')}}">Agave Azul V A.C.
          <small class="pull-right" style="align: left; text-align:center;"><h1>RECIBO DE PAGO</h1></small>
        </h2>
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
      <div class="col-sm-4 invoice-col">
        <address>
          <strong>Propietario</strong><br>
          Jonathan Josué Gómez Bustamante<br>
          Email: info@almasaeedstudio.com
        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        <address>
          <strong>Casa 10</strong><br>
          San Juan del Río
        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        <b>MANTENIMIENTO JULIO 2018</b><br>
        <b>45MTO0618</b><br>
        <br>
        <b>Tipo:</b> Transferencia<br>
        <b>Fecha de transacción:</b> 2/22/2014<br>
        <b>Fecha de emisión:</b> 2/22/2014<br>
        <b>Monto:</b> $500.00
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->



    <div class="row">

      <!-- /.col -->
      <div class="col-xs-12">


        <div class="table-responsive">
          <table class="table">
            <tr>
              <th>Cuenta Receptora:</th>
              <th>Representante de A.C.</th>
              <th>Tesorero</th>
              <th>Folio:</th>

            </tr>
            <tr>
              <td>5579 2091 1421 3975<br/>Scotiabank</td>
              <td>María de los Angeles Maya Pérez</td>
              <td>Adriana Villalobos Alvarez</td>
              <td>45MTO0618</td>
            </tr>

          </table>
        </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
</body>
</html>
