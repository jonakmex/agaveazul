<?php
namespace App\Service\Mapper;

use App\DTO\EditarMovimientoIn;
use Illuminate\Http\Request;
use App\Cuentamovimiento;
use App\Cuenta;
use \DateTime;
use Storage;
use File;

class CuentaMovimientoMapper
{
    public static function getEditarMovimientoIn(Request $request){
        $current = Cuentamovimiento::findOrFail($request->id);
        $cuenta = Cuenta::findOrFail($request['cuenta_id']);
        $editarMovimientoIn = new EditarMovimientoIn();
        $editarMovimientoIn->cuenta = $cuenta;
        $editarMovimientoIn->descripcion = $request->descripcion;
        $editarMovimientoIn->fecMov = DateTime::createFromFormat( 'Y-m-d H:i A', $request->fecha.' '.$request->hora)->format( 'Y-m-d H:i:s');
        if($request->hasFile('comprobante')){
          $file = $request->file('comprobante');
          Storage::disk('public')->put('cuenta_'.$cuenta->id.'/egresos/'.$file->getClientOriginalName(),File::get($file));
          $editarMovimientoIn->comprobante = '/storage/'.'cuenta_'.$cuenta->id.'/egresos/'.$file->getClientOriginalName();
        }
        return $editarMovimientoIn;
    }
}
