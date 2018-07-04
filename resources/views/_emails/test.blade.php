
<h1>Estimado residente de Residencial Agave Azul V</h1>

<p>Le informamos que se ha creado un nuevo recibo que puede pagar a partir de la recepción de este correo</p>
<p>Recibo:</p>
<table>
    <tr><td>Descripcion:</td><td>{{$data['recibo']->reciboheader->cuota->descripcion}} - {{$data['recibo']->descripcion}}</td></tr>
    <tr><td>Importe:</td><td>${{number_format($data['recibo']->importe, 2, ',', '.')}}</td></tr>
    <tr><td>Fecha Límite de Pago:</td><td>{{$data['recibo']->fecLimite->format('Y-m-d')}}</td></tr>
</table>
