<?php
namespace App\Service\Mapper;
use Illuminate\Http\Request;
use App\Recibos;
use App\Cuenta;
use App\DTO\PagarReciboIn;
use App\DTO\CancelarReciboIn;
use App\DTO\EliminarReciboIn;
use App\DTO\EditarReciboIn;
use \DateTime;

class ReciboMapper
{

  public static function getPagarReciboIn(Request $request)
  {
    $pagarReciboIn = new PagarReciboIn();
    //$recibo
    $recibo = Recibos::findOrFail($request->rec_id);
    $recibo->ajuste = $request->ajuste;
    $recibo->saldo = $recibo->importe + $request->ajuste;
    $recibo->fecPago = DateTime::createFromFormat( 'Y-m-d H:i A', $request->fecPago.' '.$request->timeIngreso)->format( 'Y-m-d H:i:s');
    if($request->hasFile('comprobante')){
      $recibo->comprobante = $recibo->dir().'/'.$request->file('comprobante')->getClientOriginalName();
    }
    $recibo->emision = $recibo->dir().'/emision_'.$recibo->id.'.pdf';
    $recibo->tipo_pago = $request->tipo_pago;
    $pagarReciboIn->recibo = $recibo;
    // $cuenta;
    $pagarReciboIn->cuenta = Cuenta::findOrFail($request->cuenta_id);

    // $comprobante;
    $pagarReciboIn->comprobante = $request->file('comprobante');

    return $pagarReciboIn;
  }

  public static function getEditarReciboIn(Request $request)
  {
    $editarReciboIn = new EditarReciboIn();
    //$recibo
    $recibo = Recibos::findOrFail($request->rec_id);
    $recibo->ajuste = $request->ajuste;
    $recibo->saldo = $recibo->importe + $request->ajuste;
    $recibo->fecPago = DateTime::createFromFormat( 'Y-m-d H:i A', $request->fecPago.' '.$request->timeIngreso)->format( 'Y-m-d H:i:s');
    if($request->hasFile('comprobante')){
      $recibo->comprobante = $recibo->dir().'/'.$request->file('comprobante')->getClientOriginalName();
    }
    $recibo->emision = $recibo->dir().'/emision_'.$recibo->id.'.pdf';
    $recibo->tipo_pago = $request->tipo_pago;
    $editarReciboIn->recibo = $recibo;
    // $cuenta;
    $editarReciboIn->cuenta = Cuenta::findOrFail($request->cuenta_id);

    // $comprobante;
    $editarReciboIn->comprobante = $request->file('comprobante');

    return $editarReciboIn;
  }

  public static function getCancelarReciboIn(Request $request){
    $cancelarReciboIn = new CancelarReciboIn();
    $recibo = Recibos::findOrFail($request->rec_id);
    $cancelarReciboIn->recibo = $recibo;
    return $cancelarReciboIn;
  }

  public static function getEliminarReciboIn(Request $request){
    $eliminarReciboIn = new EliminarReciboIn();
    $recibo = Recibos::findOrFail($request->rec_id);
    $eliminarReciboIn->recibo = $recibo;
    return $eliminarReciboIn;
  }

}
