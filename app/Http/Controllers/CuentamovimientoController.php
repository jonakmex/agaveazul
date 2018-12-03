<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cuenta;
use App\Cuentamovimiento;
use Storage;
use File;
use \Datetime;
use Illuminate\Support\Facades\Auth;

class CuentamovimientoController extends Controller
{
    public function create($id)
    {
      Auth::user()->authorizeRoles(['Administrador']);
      $cuenta = Cuenta::findOrFail($id);
      $cuentas = Cuenta::where('estado',1)->whereNotIn('id',[$id])->get();
      return view('movimientos.create')->with(['cuenta'=>$cuenta,'cuentas'=>$cuentas]);

    }

    public function store(Request $request)
    {
      Auth::user()->authorizeRoles(['Administrador']);
      if($request->tipo == 1) //Ingreso
      {
        // validate form data
        $this->validate($request,[
            'cuenta_id' => 'required|numeric',
            'descIngreso' => 'required|min:3|max:30',
            'ingresoImporte' => 'required|numeric',
            'fecIngreso' => 'required|date',
            'timeIngreso' => 'required',
            'compIngreso' => 'required|Image',
        ]);
        //Process de data and submit it
        $hrMov = DateTime::createFromFormat( 'Y-m-d H:i A', $request->fecIngreso.' '.$request->timeIngreso);
        $cuenta = Cuenta::findOrFail($request->cuenta_id);
        $file = $request->file('compIngreso');
        Storage::disk('public')->put('cuenta_'.$cuenta->id.'/ingresos/'.$file->getClientOriginalName(),File::get($file));

        $movimiento = new Cuentamovimiento();
        $movimiento->descripcion = $request->descIngreso;
        $movimiento->ingreso = $request->ingresoImporte;
        $movimiento->saldo = 0;
        $movimiento->fecMov = $hrMov->format( 'Y-m-d H:i:s');
        $movimiento->comprobante = '/storage/'.'cuenta_'.$cuenta->id.'/ingresos/'.$file->getClientOriginalName();
        $cuenta->movimientos()->save($movimiento);
        $cuenta->saldo = $cuenta->saldo + $movimiento->ingreso;
        $cuenta->save();

        $recalculate = Cuentamovimiento::where('cuenta_id','=',$cuenta->id)->where('fecMov','>=',$hrMov)->orderBy('fecMov','desc')->orderBy('id','desc')->get();
        $saldo = $cuenta->saldo;
        foreach($recalculate as $item){
          $item->saldo = $saldo;
          $item->save();
          $saldo += ($item->egreso - $item->ingreso);
        }

        return redirect()->route('cuentas.show',['id' => $cuenta->id]);
      }
      else if($request->tipo == 2) // Egreso
      {
        // validate form data
        $this->validate($request,[
            'cuenta_id' => 'required|numeric',
            'descEgreso' => 'required|min:3|max:30',
            'egresoImporte' => 'required|numeric',
            'fecEgreso' => 'required|date',
            'timeEgreso' => 'required',
            'compEgreso' => 'required|Image',
        ]);

        $hrMov = DateTime::createFromFormat( 'Y-m-d H:i A', $request->fecEgreso.' '.$request->timeEgreso);
        $cuenta = Cuenta::findOrFail($request->cuenta_id);
        $file = $request->file('compEgreso');
        Storage::disk('public')->put('cuenta_'.$cuenta->id.'/egresos/'.$file->getClientOriginalName(),File::get($file));

        $movimiento = new Cuentamovimiento();
        $movimiento->descripcion = $request->descEgreso;
        $movimiento->egreso = $request->egresoImporte;
        $movimiento->saldo = 0;
        $movimiento->fecMov = $hrMov->format( 'Y-m-d H:i:s');
        $movimiento->comprobante = '/storage/'.'cuenta_'.$cuenta->id.'/egresos/'.$file->getClientOriginalName();
        $cuenta->movimientos()->save($movimiento);
        $cuenta->saldo = $cuenta->saldo - $movimiento->egreso;
        $cuenta->save();

        $recalculate = Cuentamovimiento::where('cuenta_id','=',$cuenta->id)->where('fecMov','>=',$hrMov)->orderBy('fecMov','desc')->orderBy('id','desc')->get();
        $saldo = $cuenta->saldo;
        foreach($recalculate as $item){
          $item->saldo = $saldo;
          $item->save();
          $saldo += ($item->egreso - $item->ingreso);
        }

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
            'timeTransfer' => 'required',
        ]);
        //Process de data and submit it
        $hrMov = DateTime::createFromFormat( 'Y-m-d H:i A', $request->fecTransfer.' '.$request->timeTransfer);

        $ctaOrigen = Cuenta::findOrFail($request->cuenta_id);
        $ctaDestino = Cuenta::findOrFail($request->cta_dest);

        $movOrigen = new Cuentamovimiento();
        $movOrigen->descripcion = 'TRANSFER a '.$ctaDestino->descripcion;
        $movOrigen->egreso = $request->transferImporte;
        $movOrigen->fecMov = $hrMov->format( 'Y-m-d H:i:s');
        $movOrigen->saldo = 0;
        $ctaOrigen->saldo -= $movOrigen->egreso;
        $ctaOrigen->movimientos()->save($movOrigen);
        $ctaOrigen->save();

        $recalculate = Cuentamovimiento::where('cuenta_id','=',$ctaOrigen->id)->where('fecMov','>=',$hrMov)->orderBy('fecMov','desc')->orderBy('id','desc')->get();
        $saldo = $ctaOrigen->saldo;
        foreach($recalculate as $item){
          $item->saldo = $saldo;
          $item->save();
          $saldo += ($item->egreso - $item->ingreso);
        }

        $movDestino = new Cuentamovimiento();
        $movDestino->descripcion = 'TRANSFER de '.$ctaOrigen->descripcion;
        $movDestino->ingreso = $request->transferImporte;
        $movDestino->fecMov = $hrMov->format( 'Y-m-d H:i:s');
        $movDestino->saldo = 0;
        $ctaDestino->saldo += $request->transferImporte;
        $ctaDestino->movimientos()->save($movDestino);
        $ctaDestino->save();

        $recalculate = Cuentamovimiento::where('cuenta_id','=',$ctaDestino->id)->where('fecMov','>=',$hrMov)->orderBy('fecMov','desc')->orderBy('id','desc')->get();
        $saldo = $ctaDestino->saldo;
        foreach($recalculate as $item){
          $item->saldo = $saldo;
          $item->save();
          $saldo += ($item->egreso - $item->ingreso);
        }

        return redirect()->route('cuentas.show',['id' => $ctaOrigen->id]);
      }


    }
}
