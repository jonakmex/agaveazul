<?php
namespace App\Service;
use App\DTO\AddMovimientoIn;
use App\Cuentamovimiento;

class CuentaService
{
  public static function movimiento(AddMovimientoIn $in)
  {
    /*Create Movimiento cuenta record*/
    $cuenta = $in->cuenta;

    $movimiento = new Cuentamovimiento();
    $movimiento->descripcion = $in->descripcion;
    $movimiento->ingreso = $in->ingreso;
    $movimiento->egreso = $in->egreso;
    $movimiento->fecMov = $in->fecha;
    $movimiento->comprobante = $in->comprobante;
    $cuenta->movimientos()->save($movimiento);

    $cuenta->saldo += $movimiento->ingreso;
    $cuenta->save();

    $recalculate = Cuentamovimiento::where('cuenta_id','=',$cuenta->id)->where('fecMov','>=',$in->fecha)->orderBy('fecMov','desc')->orderBy('id','desc')->get();
    $saldo = $cuenta->saldo;
    foreach($recalculate as $item){
      $item->saldo = $saldo;
      $item->save();
      $saldo += ($item->egreso - $item->ingreso);
    }

  }


}
