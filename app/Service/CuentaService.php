<?php
namespace App\Service;
use App\DTO\AddMovimientoIn;
use App\Cuentamovimiento;
use App\Cuenta;

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

    CuentaService::recalcularSaldo($cuenta);

  }

  public static function recalcularSaldo(Cuenta $cuenta){
    $recalculate = Cuentamovimiento::where('cuenta_id','=',$cuenta->id)->orderBy('fecMov','asc')->orderBy('id','asc')->get();
    $saldo = 0;
    foreach($recalculate as $item){
      $saldo += ($item->ingreso - $item->egreso);
      $item->saldo = $saldo;
      $item->save();

    }
    $cuenta->saldo = $saldo;
    $cuenta->save();
  }
}
