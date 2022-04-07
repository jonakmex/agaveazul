<html>
<head>
  <style>
    table{
      border-collapse: collapse;
      font-family: Arial, Helvetica, sans-serif;
    }
    th {
      text-align: center;
    }
    td {
      text-align: center;
    }
    table span.main{
      color:#000080;
      font-size:150%;
    }

    table span.subtitle{
      color:#000080;
      font-size:90%;
    }

    tr:nth-child(even) {
    background-color: #b6c8cf;
    }
    
  </style>
</head>
<body>
  {{date_default_timezone_set('America/Mexico_City') ? "":""}}  
<table border="1" width="90%">
  <tr>
    <td  colspan="1"><img height="100" src="{{public_path('img/recibo/header.png')}}" /></td>
    <td  colspan="3">
      <span class="main"><strong>PENDIENTE DE PAGO</strong></span><p>
      <span class="subtitle">Fecha actualizaci&oacute;n:<p>{{$fecha}}</span>
    </td>
  </tr>
    <tr>
        <th>Cuota</th>
        <th>Recibo</th>
        <th>Fecha limite</th>
        <th>Importe</th>
    </tr>
    @foreach ($recibos as $recibo)
    <tr>
      <td>{{$recibo->reciboheader->cuota->descripcion}}</td>
      <td>{{$recibo->descripcion}}</td>
      <td>{{$recibo->fecLimite}}</td>
      <td>${{round( $recibo->importe,2)}}</td>
    </tr>
    @endforeach
    <tr>
        <td colspan="3" style="text-align: right;"><h3>Total</h3></td>
        <td><h3>${{round($total,2)}}</h3></td>
    </tr>
</table>
</body>
<html>
