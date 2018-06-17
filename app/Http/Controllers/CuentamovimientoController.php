<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cuenta;
use App\Cuentamovimiento;
use Storage;
use File;
use \Datetime;
class CuentamovimientoController extends Controller
{
    public function create($id)
    {
      $cuenta = Cuenta::findOrFail($id);
      $cuentas = Cuenta::where('estado',1)->whereNotIn('id',[$id])->get();
      return view('admin.movimientos.create')->with(['cuenta'=>$cuenta,'cuentas'=>$cuentas]);

    }

    public function store(Request $request)
    {
      if($request->tipo == 1) //Ingreso
      {
        // validate form data
        $this->validate($request,[
            'cuenta_id' => 'required|numeric',
            'descripcion' => 'required|min:3|max:30',
            'ingresoImporte' => 'required|numeric',
            'fecIngreso' => 'required|date',
            'timeIngreso' => 'required',
            'compIngreso' => 'required|Image',
        ]);
        //Process de data and submit it
        $cuenta = Cuenta::findOrFail($request->cuenta_id);
        $lastMov = $cuenta->movimientos()->orderBy('id','desc')->first();
        $saldoLast = $lastMov!=null?$lastMov->saldo:0;

        $file = $request->file('compIngreso');
        Storage::disk('public')->put('cuenta_'.$cuenta->id.'/ingresos/'.$file->getClientOriginalName(),File::get($file));

        $hrMov = DateTime::createFromFormat( 'Y-m-d H:i A', $request->fecIngreso.' '.$request->timeIngreso);

        $movimiento = new Cuentamovimiento();
        $movimiento->descripcion = $request->descripcion;
        $movimiento->ingreso = $request->ingresoImporte;
        $movimiento->saldo = $saldoLast + $movimiento->ingreso;
        $movimiento->fecMov = $hrMov->format( 'Y-m-d H:i:s');
        $movimiento->comprobante = '/storage/'.'cuenta_'.$cuenta->id.'/ingresos/'.$file->getClientOriginalName();
        $cuenta->movimientos()->save($movimiento);

        $cuenta->saldo = $movimiento->saldo;
        $cuenta->save();
        return redirect()->route('cuentas.show',['id' => $cuenta->id]);
      }
      else if($request->tipo == 2) // Egreso
      {
        // validate form data
        $this->validate($request,[
            'cuenta_id' => 'required|numeric',
            'descripcion' => 'required|min:3|max:30',
            'egresoImporte' => 'required|numeric',
            'fecEgreso' => 'required|date',
            'compEgreso' => 'required|Image',
        ]);
        //Process de data and submit it
        $cuenta = Cuenta::findOrFail($request->cuenta_id);
        $lastMov = $cuenta->movimientos()->orderBy('id','desc')->first();

        $saldoLast = $lastMov!=null?$lastMov->saldo:0;

        $file = $request->file('compEgreso');
        Storage::disk('public')->put('cuenta_'.$cuenta->id.'/egresos/'.$file->getClientOriginalName(),File::get($file));

        $movimiento = new Cuentamovimiento();
        $movimiento->descripcion = $request->descripcion;
        $movimiento->egreso = $request->egresoImporte;
        $movimiento->saldo = $saldoLast - $movimiento->egreso;
        $movimiento->fecMov = $request->fecEgreso;
        $movimiento->comprobante = '/storage/'.'cuenta_'.$cuenta->id.'/egresos/'.$file->getClientOriginalName();
        $cuenta->movimientos()->save($movimiento);

        $cuenta->saldo = $movimiento->saldo;
        $cuenta->save();
        return redirect()->route('cuentas.show',['id' => $cuenta->id]);
      }
      else //Transferencia
      {
        // validate form data
        $this->validate($request,[
            'cuenta_id' => 'required|numeric',
            'cta_dest' => 'required|numeric',
            'transferImporte' => 'required|numeric',
            'fecTransfer' => 'required|date',
        ]);
        //Process de data and submit it
        $ctaOrigen = Cuenta::findOrFail($request->cuenta_id);
        $ctaDestino = Cuenta::findOrFail($request->cta_dest);

        $lastOrigen = $ctaOrigen->movimientos()->orderBy('id','desc')->first();
        $lastDestino = $ctaDestino->movimientos()->orderBy('id','desc')->first();

        $saldoOrigen = $lastOrigen!=null?$lastOrigen->saldo:0;
        $saldoDestino = $lastDestino!=null?$lastDestino->saldo:0;

        $movOrigen = new Cuentamovimiento();
        $movOrigen->descripcion = 'TRANSFER a '.$ctaDestino->descripcion;
        $movOrigen->egreso = $request->transferImporte;
        //$movOrigen->fecMov = $request->fecTransfer;
        $movOrigen->saldo = $saldoOrigen - $movOrigen->egreso;
        $ctaOrigen->saldo = $movOrigen->saldo;
        $ctaOrigen->movimientos()->save($movOrigen);
        $ctaOrigen->save();
        $movDestino = new Cuentamovimiento();
        $movDestino->descripcion = 'TRANSFER de '.$ctaOrigen->descripcion;
        $movDestino->ingreso = $request->transferImporte;
        //$movOrigen->fecMov = $request->fecTransfer;
        $movDestino->saldo = $saldoDestino + $movDestino->ingreso;
        $ctaDestino->saldo = $movDestino->saldo;
        $ctaDestino->movimientos()->save($movDestino);
        $ctaDestino->save();
        return redirect()->route('cuentas.show',['id' => $ctaOrigen->id]);
      }


    }
}
