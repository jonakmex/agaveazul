<?php
namespace App\Service;

use App\Vivienda;
use App\Recibos;
use App\BusinessException;
use \Datetime;

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

}
