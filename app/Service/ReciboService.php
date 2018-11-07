<?php
namespace App\Service;
use App\Recibos;

use App\Service\Mapper\ReciboMapper;
use App\Service\CuentaService;
use App\DTO\PagarReciboIn;
use App\DTO\AddMovimientoIn;
use App\AvisoMail;
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
    Mail::to($recibo->vivienda->contactoPrincipal()->email)->queue(new AvisoMail($data,$file,1));

  }

  public static function actualizarSaldo(){
    $reciboheader = $recibo->reciboheader;
    $reciboheader->saldo = $reciboheader->saldo + $movimiento->ingreso;
    $reciboheader->save();
  }
}
