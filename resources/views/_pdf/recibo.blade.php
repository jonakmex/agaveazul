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
    table span.title{
      color:#000099;
      font-size:60%;
    }
    table span.title-min{
      color:blue;
      font-size:40%;
    }
    table span.casa{
      color:red;
      font-size:150%;
    }
    table span.green{
      color:green
    }
    table span.concepto{
      color:#cc3300
    }
    table span.emision{
      color:#ff6600
    }
  </style>
</head>
<body>
  {{date_default_timezone_set('America/Mexico_City') ? "":""}}  
<table border="1">
  <tr>
    <td rowspan="3" colspan="3"><img height="100" src="{{public_path('img/recibo/header.png')}}" /></td>
    <td colspan="9"><span class="main"><strong>RECIBO DE PAGO</strong></span></td>
  </tr>
  <tr>
    <td colspan="3">San Juan del Río, QRO</td>
    <td><span class="emision">{{date("d",time())}}</span></td>
    <td colspan="2"><span class="emision">{{date("m",time())}}</span></td>
    <td><span class="emision">{{date("Y",time())}}</span></td>
    <td colspan="2"><span class="casa"><strong>{{$recibo->vivienda->clave}}</strong></span></td>
  </tr>
  <tr>
    <td colspan="3"><span class="title">FECHA DE EMISIÓN</span></td>
    <td><span class="title">DIA</span></td>
    <td colspan="2"><span class="title">MES</span></td>
    <td><span class="title">AÑO</span></td>
    <td colspan="2"><span class="title">CASA</span></td>
  </tr>
  <tr>
    <td rowspan="2" colspan="3"><span class="green">{{date_create($recibo->fecPago)->format('d/m/Y')}}</span></td>
    <td rowspan="2" colspan="9">{{$recibo->vivienda->contactoPrincipal()->nombre}}</td>
  </tr>
  <tr></tr>
  <tr>
    <td  colspan="3"><span class="title">FECHA DE TRANSACCIÓN</span></td>
    <td  colspan="9"><span class="title">NOMBRE DEL PROPIETARIO</span></td>
  </tr>
  <tr>
    <td rowspan="2" colspan="3"><span class="green">
    @switch($recibo->tipo_pago)
    @case(1)
      TRANSFERENCIA
      @break
    @case(2)
      DEPÓSITO
      @break
    @case(3)
      EFECTIVO
    @endswitch
    </span></td>

    <td colspan="3"><span class="green"><strong>${{number_format($recibo->importe + $recibo->ajuste, 2, '.', ',')}}</strong></span></td>
    <td colspan="4"><span class="concepto">{{$recibo->reciboHeader->cuota->descripcion}}</span></td>
    <td colspan="2"><span class="concepto">{{$recibo->reciboHeader->descripcion}}</span></td>
  </tr>
  <tr>
    <td colspan="3"> <span class="concepto">({{$recibo->importeLetra()}})</span></td>
    <td><span class="title-min">APAR DE PALAPA</span></td>
    <td><span class="title-min">EXT / ESP</span></td>
    <td><span class="title-min">ANUAL</span></td>
    <td><span class="title-min">MNTO</span></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td colspan="3"><span class="title">TIPO DE TRANSACCIÓN</span></td>
    <td colspan="3"><span class="title">CANTIDAD</span></td>
    <td colspan="6"><span class="title">CONCEPTO</span></td>
  </tr>
  <tr>
    <td colspan="3"><p>CTA: 25600009260
      <p>CLABE: 044685256000092609
    </td>
    <td colspan="3">Andrea Stephany Bañuelos Reyes</td>
    <td colspan="4">Alma Rosa Villarreal Luján</td>
    <td rowspan="2" colspan="2">{{$recibo->folio()}}</td>
  </tr>
  <tr>
    <td colspan="3">Scotiabank</td>
    <td colspan="3"><span class="title">Representante de A.C.</span></td>
    <td colspan="4"><span class="title">Tesorero</span></td>
  </tr>
  <tr>
    <td colspan="3"><span class="title">CUENTA RECEPTORA</span></td>
    <td colspan="7"><span class="title">RECIBEN (este combrobante sustituye al antes emitido)</span></td>
    <td colspan="2"><span class="title">FOLIO</span></td>
  </tr>

</table>
</body>
<html>
