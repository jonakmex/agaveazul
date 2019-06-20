<?php
namespace App\Service;


use App\Service\Mapper\ReciboMapper;
use App\Service\CuentaService;
use App\Service\ConfigService;
use App\DTO\PagarReciboIn;
use App\DTO\EditarReciboIn;
use App\DTO\CancelarReciboIn;
use App\DTO\AddMovimientoIn;
use App\Recibos;
use App\AvisoMail;
use App\Cuota;
use App\Reciboheader;
use App\Vivienda;
use App\Config;
use \DateTime;
use PDF;
use Mail;
use Storage;
use File;
use Log;
use DB;
use Carbon\Carbon;

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
    $movimiento->recibos_id = $recibo->id;
    $movimiento->fecha = $recibo->fecPago;
    if($movimiento->comprobante != null){
        $movimiento->comprobante = $recibo->dir().'/'.$pagarReciboIn->comprobante->getClientOriginalName();;
    }

    CuentaService::movimiento($movimiento);

    if($recibo->reciboheader != null){
      $reciboheader = $recibo->reciboheader;
      $reciboheader->saldo = $reciboheader->saldo + $movimiento->ingreso;
      $reciboheader->save();
    }

    //Subir archivo
    if($movimiento->comprobante != null){
      Storage::disk('public')->put($recibo->storage().'/'.$pagarReciboIn->comprobante->getClientOriginalName(),File::get($pagarReciboIn->comprobante));
    }
    //Generar PDF
    $pdf = PDF::loadView('_pdf.recibo', compact('recibo'));
    Storage::disk('public')->put($recibo->storage().'/'.'emision_'.$recibo->id.'.pdf', $pdf->output());

    $data = array('recibo'=>$recibo);
    $file = storage_path('app/public/rec_'.$recibo->id.'/emision_'.$recibo->id.'.pdf');
    Log::debug('Sending to .'.$recibo->vivienda->contactoPrincipal()->email);

    
    if(ConfigService::mailEnabled()){
      Mail::to($recibo->vivienda->contactoPrincipal()->email)->queue(AvisoMail::newAvisoPagoExitoso($data,$file));
    }
  }

  public static function editar(EditarReciboIn $editarReciboIn){
    $recibo = $editarReciboIn->recibo;
    $movimiento = $recibo->movimiento;
    $original = Recibos::findOrFail($recibo->id);
    $cuentaOrigen = $original->movimiento->cuenta;
    $recibo->save();

    $recalcularSaldos = false;

    if($cuentaOrigen->id != $editarReciboIn->cuenta->id){
      $recalcularSaldos = true;
      $movimiento->cuenta_id = $editarReciboIn->cuenta->id;
    }

    if($original->saldo != $recibo->saldo){

      $movimiento->ingreso = $recibo->importe+$recibo->ajuste;;
      $movimiento->egreso = 0 ;
      $movimiento->fecMov = $recibo->fecPago;
      $recalcularSaldos = true;

      if($recibo->reciboheader != null){
        $reciboheader = $recibo->reciboheader;
        $reciboheader->saldo = $reciboheader->saldo + $movimiento->ingreso;
        $reciboheader->save();
      }

      //Subir archivo
      if($movimiento->comprobante != null){
        Storage::disk('public')->put($recibo->storage().'/'.$editarReciboIn->comprobante->getClientOriginalName(),File::get($editarReciboIn->comprobante));
      }
      //Generar PDF
      $pdf = PDF::loadView('_pdf.recibo', compact('recibo'));
      Storage::disk('public')->put($recibo->storage().'/'.'emision_'.$recibo->id.'.pdf', $pdf->output());

      $data = array('recibo'=>$recibo);
      $file = storage_path('app/public/rec_'.$recibo->id.'/emision_'.$recibo->id.'.pdf');
      Log::debug('Sending to .'.$recibo->vivienda->contactoPrincipal()->email);
      
      if(ConfigService::mailEnabled()){
        Mail::to($recibo->vivienda->contactoPrincipal()->email)->queue(AvisoMail::newAvisoPagoExitoso($data,$file));
      }
    }

    if($movimiento->comprobante != null){
        $movimiento->comprobante = $recibo->dir().'/'.$editarReciboIn->comprobante->getClientOriginalName();;
    }

    $movimiento->save();

    if($recalcularSaldos){
      CuentaService::recalcularSaldo($cuentaOrigen);
      CuentaService::recalcularSaldo($editarReciboIn->cuenta);
    }

  }

  public static function cancelar(CancelarReciboIn $cancelarReciboIn){
      $recibo = $cancelarReciboIn->recibo;
      $recibo->estado = 1;
      $recibo->save();
      $movimiento = $recibo->movimiento;
      $cuenta = $movimiento->cuenta;
      $movimiento->delete();
      CuentaService::recalcularSaldo($cuenta);
  }

  public static function actualizarSaldo(){
    $reciboheader = $recibo->reciboheader;
    $reciboheader->saldo = $reciboheader->saldo + $movimiento->ingreso;
    $reciboheader->save();
  }

  public static function generarRecibos(){
    info('Running generarRecibos...');
    $today = date('Y-m-d');
    $cuotasVigentes = Cuota::where('estado',1)->whereDate('fecPago','<=',Carbon::today()->toDateString())->get();
    foreach($cuotasVigentes as $cuota){
      if(ReciboService::esActiva($cuota)){
        $headersPorGenerar = ReciboService::obtenerHeadersPorGenerar($cuota);
        foreach($headersPorGenerar as $fechaPorGenerar){
          ReciboService::generarHeaderRecibo($cuota,$fechaPorGenerar);
        }
        $headersPorProcesar = ReciboService::consultarRecibosHeaderPorProcesar($cuota);
        foreach($headersPorProcesar as $reciboHeader){
          ReciboService::generarRecibosVivienda($reciboHeader);
        }
      }
    }
    info('generarRecibos Done.');
  }

  private static function esActiva(Cuota $cuota)
  {
    $result = false;
    $today = date('Y-m-d H:i:s');
    if($cuota->periodicidad === null){
      $result = true;
    } elseif ($cuota->periodicidad != null && ($cuota->nPeriodos == 0 || count($cuota->recibosHeader) < $cuota->nPeriodos)){
      $result = true;
    } else {
      $numeroViviendas = $cuota->viviendas()->count();
      $headers = $cuota->recibosHeader()->get();
      foreach($headers as $reciboHeader){
        if($reciboHeader->recibos->count() < $numeroViviendas){
          $result = true;
        }
      }
    }
    return $result;
  }

  private static function obtenerHeadersPorGenerar(Cuota $cuota){
    $resultado = array();
    $headers = $cuota->recibosHeader;
    $fechaPago = $cuota->fecPago;
    if($cuota->periodicidad != null){
      while(ReciboService::existenRecibosPorGenerar($cuota,$fechaPago,count($headers)+count($resultado))){
        if(!ReciboService::existeHeader($headers,$fechaPago))
        {
          array_push($resultado,$fechaPago);
        }

        $fechaPago = ReciboService::siguienteFechaPago($cuota,$fechaPago);
      }
    }
    else{
      if(!ReciboService::existeHeader($headers,$fechaPago))
      {
        array_push($resultado,$fechaPago);
      }
    }

    return $resultado;
  }

  private static function consultarRecibosHeaderPorProcesar(Cuota $cuota){
    $resultado = array();
    $numeroViviendas = $cuota->viviendas()->count();
    $headers = $cuota->recibosHeader()->get();
    foreach($headers as $reciboHeader){
        if($reciboHeader->recibos->count() < $numeroViviendas
        && Carbon::now()>=$reciboHeader->fecVence){
            array_push($resultado,$reciboHeader);
        }
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
    setlocale(LC_ALL,"es_MX.UTF-8");
    switch($cuota->periodicidad){
        case 1:
          $resultado = ''.strtoupper(strftime("%b", strtotime($fechaPago))).' '.strtoupper(strftime("%Y", strtotime($fechaPago)));
        break;
        case 2:
          $resultado = ''.strtoupper(strftime("%Y", strtotime($fechaPago)));
        break;
        default:
          $resultado = $cuota->descripcion;
    }
    return $resultado;
  }

  public static function siguienteFechaPago(Cuota $cuota,$fechaPagoInicial){
    $resultado = $cuota->fecPago;
    if($fechaPagoInicial != null){
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
    }

    return $resultado;
  }

  public static function generarHeaderRecibo(Cuota $cuota,$fechaPorGenerar){
    $reciboHeader = new Reciboheader();
    $reciboHeader->descripcion = ReciboService::obtenerDescripcion($cuota,$fechaPorGenerar); // PERIODO
    $reciboHeader->importe = $cuota->importe;
    $reciboHeader->saldo = 0.0;
    $reciboHeader->fecVence = $fechaPorGenerar;
    $reciboHeader->fecLimite = date_add(date_create($fechaPorGenerar), date_interval_create_from_date_string($cuota->periodoGracia.' days'));
    $reciboHeader->estado = 1;
    $cuota->recibosHeader()->save($reciboHeader);
    return $reciboHeader;
  }

  public static function generarRecibosVivienda(Reciboheader $reciboHeader){
    $cuota = $reciboHeader->cuota;
    foreach($cuota->viviendas as $cuotavivienda){
      $vivienda = $cuotavivienda->vivienda;
      if(!ReciboService::existeReciboVivienda($reciboHeader,$vivienda)){
        ReciboService::generarReciboVivienda($reciboHeader,$vivienda);
      }
    }
  }

  public static function generarReciboVivienda(Reciboheader $reciboHeader,Vivienda $vivienda){
    $recibo = new Recibos();
    $recibo->vivienda_id = $vivienda->id;
    $recibo->descripcion = $reciboHeader->descripcion;
    $recibo->fecLimite = $reciboHeader->fecLimite;
    $recibo->importe = $reciboHeader->cuota->importe;
    $recibo->estado = 1;
    $recibo->saldo = 0;
    $reciboHeader->recibos()->save($recibo);
    ReciboService::avisoReciboVivienda($recibo);
    return $reciboHeader;
  }


  private static function existeReciboVivienda(Reciboheader $reciboHeader,Vivienda $vivienda){
    return DB::table('recibos')->where('reciboheader_id', $reciboHeader->id)->where('vivienda_id',$vivienda->id)->exists();
  }

  private static function avisoReciboVivienda(Recibos $recibo){
    $data = array('recibo'=>$recibo);
    if(ConfigService::mailEnabled()){
      Mail::to($recibo->vivienda->contactoPrincipal()->email)->queue(AvisoMail::newAvisoReciboGenerado($data));
    }
  }
}
