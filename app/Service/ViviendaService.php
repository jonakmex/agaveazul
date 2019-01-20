<?php
namespace App\Service;

use App\Vivienda;
use App\Recibos;
use App\Cuota;
use App\BusinessException;
use \Datetime;
use App\Service\ReciboService;

class ViviendaService
{
    public static function save(Vivienda $vivienda)
    {
      if($vivienda->save()){
        return $vivienda;
      }
      else{
        throw new BusinessException();
      }
    }

    public static function calcularSaldo(Vivienda $vivienda)
    {
      return Recibos::where('estado',1)->where('vivienda_id',$vivienda->id)->sum('importe');
    }

    public static function calcularEstatus(Vivienda $vivienda)
    {
      $recibos = Recibos::where('estado',1)->where('vivienda_id',$vivienda->id)->get();
      $estado = 1; //Al corriente
      $today = new DateTime("now");
      foreach($recibos as $recibo){
        $fechaPago = new DateTime($recibo->reciboheader->cuota->fecPago);
        if($fechaPago < $today ){
          $estado = 2; //En mora
          break;
        }
      }
      return $estado;
    }

    public static function generarSiguienteRecibo(Vivienda $vivienda,Cuota $cuota){
      // Obtener ultimo recibo header de la cuota
      $ultimoReciboHeader = $cuota->recibosHeader()->orderBy('id','desc')->first();
      // Generar el siguiente recibo header
      $fechaSiguienteHeader = ReciboService::siguienteFechaPago($cuota,$ultimoReciboHeader->fecVence);
      $reciboHeader = ReciboService::generarHeaderRecibo($cuota,$fechaSiguienteHeader);
      // Generar el recibo
      return ReciboService::generarReciboVivienda($reciboHeader,$vivienda);
    }
}
