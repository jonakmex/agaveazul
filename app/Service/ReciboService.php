<?php
namespace App\Service;
use App\Recibos;

use App\Service\Mapper\ReciboMapper;
use App\Service\CuentaService;
use App\DTO\PagarReciboIn;
use App\DTO\AddMovimientoIn;
use App\AvisoMail;
use App\Cuota;
use App\Reciboheader;
use App\Vivienda;
use \DateTime;
use PDF;
use Mail;
use Storage;
use File;
use Log;

class ReciboService
{

  public static function pagar(PagarReciboIn $pagarReciboIn){
    $recibo = $pagarReciboIn->recibo;
    $recibo->estado = 2; //Pagado
    $recibo->save();

    $movimiento = new AddMovimientoIn();
    $movimiento->cuenta = $pagarReciboIn->cuenta;
    $movimiento->descripcion = $recibo->reciboheader != null?$recibo->reciboheader->cuota->descripcion.' > '.$recibo->vivienda->descripcion.' > '.$recibo->descripcion:$recibo->descripcion;
    $movimiento->ingreso = $recibo->importe+$recibo->ajuste;;
    $movimiento->egreso = 0 ;
    $movimiento->fecha = $recibo->fecPago;
    $movimiento->comprobante = $recibo->dir().'/'.$pagarReciboIn->comprobante->getClientOriginalName();;
    CuentaService::movimiento($movimiento);

    if($recibo->reciboheader != null){
      $reciboheader = $recibo->reciboheader;
      $reciboheader->saldo = $reciboheader->saldo + $movimiento->ingreso;
      $reciboheader->save();
    }

    //Subir archivo
    Storage::disk('public')->put($recibo->storage().'/'.$pagarReciboIn->comprobante->getClientOriginalName(),File::get($pagarReciboIn->comprobante));
    //Generar PDF
    $pdf = PDF::loadView('_pdf.recibo', compact('recibo'));
    Storage::disk('public')->put($recibo->storage().'/'.'emision_'.$recibo->id.'.pdf', $pdf->output());

    $data = array('recibo'=>$recibo);
    $file = storage_path('app/public/rec_'.$recibo->id.'/emision_'.$recibo->id.'.pdf');
    Log::debug('Sending to .'.$recibo->vivienda->contactoPrincipal()->email);
    Mail::to($recibo->vivienda->contactoPrincipal()->email)->queue(AvisoMail::newAvisoPagoExitoso($data,$file));

  }

  public static function actualizarSaldo(){
    $reciboheader = $recibo->reciboheader;
    $reciboheader->saldo = $reciboheader->saldo + $movimiento->ingreso;
    $reciboheader->save();
  }

  public static function generarRecibos(){
    info('Running Service...');
    $today = date('Y-m-d H:i:s');
    $cuotasVigentes = Cuota::where('estado',1)->whereNotNull('periodicidad')->where('fecPago','<',$today)->get();
    foreach($cuotasVigentes as $cuota){
      if(ReciboService::esActiva($cuota)){
        $headersPorGenerar = ReciboService::obtenerHeadersPorGenerar($cuota);
        info('Por Generar '.count($headersPorGenerar));
        foreach($headersPorGenerar as $fechaPorGenerar){
          ReciboService::generarRecibo($cuota,$fechaPorGenerar);
        }
        info($cuota->descripcion.' ['.count($headersPorGenerar).' Recibos generados]');
      }
    }
    info('Service Done.');
  }

  private static function esActiva(Cuota $cuota)
  {
    return $cuota->periodicidad != null && ($cuota->nPeriodos == 0 || count($cuota->recibosHeader) < $cuota->nPeriodos);
  }

  private static function obtenerHeadersPorGenerar(Cuota $cuota){
    $resultado = array();
    $headers = $cuota->recibosHeader;
    $fechaPago = $cuota->fecPago;

    while(ReciboService::existenRecibosPorGenerar($cuota,$fechaPago,count($headers)+count($resultado))){
      if(!ReciboService::existeHeader($headers,$fechaPago))
      {
        array_push($resultado,$fechaPago);
      }

      $fechaPago = ReciboService::siguienteFechaPago($cuota,$fechaPago);
    }
    return $resultado;
  }

  private static function existenRecibosPorGenerar(Cuota $cuota,$fechaPago,$numeroRecibos){
    $today = date('Y-m-d H:i:s');
    return $fechaPago < $today && ( $numeroRecibos < $cuota->nPeriodos || $cuota->nPeriodos == 0);
  }

  private static function existeHeader($listaHeaders,$fecha)
  {
    $existe = false;
    foreach($listaHeaders as $header){
      if(date_diff(date_create($fecha),date_create($header->fecVence))->format('%a')==0){
        $existe = true;
        break;
      }
    }
    return $existe;
  }

  private static function obtenerDescripcion(Cuota $cuota,$fechaPago){
    $resultado = "";
    switch($cuota->periodicidad){
        case 1:
          $resultado = ''.strtoupper(date("M", strtotime($fechaPago))).' '.strtoupper(date("Y", strtotime($fechaPago)));
        break;
        case 2:
          $resultado = ''.strtoupper(date("Y", strtotime($fechaPago)));
        break;
        default:
          $resultado = $cuota->descripcion;
    }
    return $resultado;
  }

  private static function siguienteFechaPago(Cuota $cuota,$fechaPagoInicial){
    $resultado = date('Y-m-d H:i:s');
    switch($cuota->periodicidad){
            case 1:
              $resultado = date('Y-m-d', strtotime("+1 months", strtotime($fechaPagoInicial)));
            break;
            case 2:
              $resultado = date('Y-m-d', strtotime("+1 years", strtotime($fechaPagoInicial)));
            break;
            default:
              $resultado = date('Y-m-d', strtotime("+1 days", strtotime($fechaPagoInicial)));
        }
    return $resultado;
  }

  private static function generarRecibo(Cuota $cuota,$fechaPorGenerar){
    $reciboHeader = new Reciboheader();
    $reciboHeader->descripcion = ReciboService::obtenerDescripcion($cuota,$fechaPorGenerar); // PERIODO
    $reciboHeader->importe = $cuota->importe;
    $reciboHeader->saldo = 0.0;
    $reciboHeader->fecVence = $fechaPorGenerar;
    $reciboHeader->fecLimite = date_add(date_create($fechaPorGenerar), date_interval_create_from_date_string($cuota->periodoGracia.' days'));
    $reciboHeader->estado = 1;
    $cuota->recibosHeader()->save($reciboHeader);

    foreach($cuota->viviendas as $cuotavivienda){
      $recibo = new Recibos();
      $recibo->vivienda_id = $cuotavivienda->vivienda_id;
      $recibo->descripcion = $reciboHeader->descripcion;
      $recibo->fecLimite = $reciboHeader->fecLimite;
      $recibo->importe = $cuota->importe;
      $recibo->estado = 1;
      $recibo->saldo = 0;
      $reciboHeader->recibos()->save($recibo);
      ReciboService::avisoReciboVivienda($recibo);
    }

  }

  private static function avisoReciboVivienda(Recibos $recibo){
    $data = array('recibo'=>$recibo);
    Mail::to($recibo->vivienda->contactoPrincipal()->email)->queue(AvisoMail::newAvisoReciboGenerado($data));
  }
}
