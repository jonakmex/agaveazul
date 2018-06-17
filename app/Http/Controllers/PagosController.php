<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
use File;
use App\Recibos;
use App\Cuenta;
use App\Cuentamovimiento;

class PagosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pagos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $this->validate($request,[
        //'importe' => 'required|numeric',
        'ajuste' => 'required|numeric',
        'fecPago' => 'required|date',
        'rec_id' => 'required',
        'cuenta_id' => 'required',
        'comprobante' => 'required|Image',
      ]);

        $file = $request->file('comprobante');
        $recibo = Recibos::findOrFail($request->rec_id);

        /*PAGAR RECIBO*/
        Storage::disk('public')->put('rec_'.$recibo->id.'/'.$file->getClientOriginalName(),File::get($file));
        $recibo->ajuste = $request->ajuste;
        $recibo->saldo = $recibo->importe + $recibo->ajuste;
        $recibo->fecPago = $request->fecPago;
        $recibo->comprobante = '/storage/'.'rec_'.$recibo->id.'/'.$file->getClientOriginalName();
        $recibo->estado = 2; //Pagado
        $recibo->save();

        /*Create Movimiento cuenta record*/
        $cuenta = Cuenta::findOrFail($request->cuenta_id);
        $lastMov = $cuenta->movimientos()->orderBy('id','desc')->first();
        $lastSaldo = $lastMov != null ? $lastMov->saldo : 0;
        $movimiento = new Cuentamovimiento();
        $movimiento->descripcion = $recibo->reciboheader->cuota->descripcion.' > '.$recibo->vivienda->descripcion.' > '.$recibo->descripcion;
        $movimiento->ingreso = $recibo->importe+$recibo->ajuste;
        $movimiento->saldo = $lastSaldo + $movimiento->ingreso;
        $movimiento->fecMov = $request->fecPago;
        $movimiento->comprobante = '/storage/'.'rec_'.$recibo->id.'/'.$file->getClientOriginalName();
        $cuenta->movimientos()->save($movimiento);

        $reciboheader = $recibo->reciboheader;
        $reciboheader->saldo = $reciboheader->saldo + $movimiento->ingreso;
        $reciboheader->save();

        $cuenta->saldo = $movimiento->saldo;
        $cuenta->save();

        return view('admin.recibosheader.show')->with('reciboHeader',$recibo->reciboheader);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.pagos.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
