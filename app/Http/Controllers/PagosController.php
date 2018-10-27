<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
use File;
use App\Recibos;
use App\Cuenta;
use App\Cuentamovimiento;
use \Datetime;
use PDF;

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
        //return view('admin.pagos.create');
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
        'timeIngreso' => 'required',
        'rec_id' => 'required',
        'cuenta_id' => 'required',
        'comprobante' => 'required|Image',
      ]);

        $file = $request->file('comprobante');
        $recibo = Recibos::findOrFail($request->rec_id);

        $hrMov = DateTime::createFromFormat( 'Y-m-d H:i A', $request->fecPago.' '.$request->timeIngreso);

        /*PAGAR RECIBO*/
        Storage::disk('public')->put('rec_'.$recibo->id.'/'.$file->getClientOriginalName(),File::get($file));
        $recibo->ajuste = $request->ajuste;
        $recibo->saldo = $recibo->importe + $recibo->ajuste;
        $recibo->fecPago = $hrMov->format( 'Y-m-d H:i:s');
        $recibo->comprobante = '/storage/'.'rec_'.$recibo->id.'/'.$file->getClientOriginalName();
        $recibo->estado = 2; //Pagado
        $recibo->save();

        /*Create Movimiento cuenta record*/
        $cuenta = Cuenta::findOrFail($request->cuenta_id);

        $movimiento = new Cuentamovimiento();
        $movimiento->descripcion = $recibo->reciboheader != null?$recibo->reciboheader->cuota->descripcion.' > '.$recibo->vivienda->descripcion.' > '.$recibo->descripcion:$recibo->descripcion;
        $movimiento->ingreso = $recibo->importe+$recibo->ajuste;
        $movimiento->saldo = 0;
        $movimiento->fecMov = $hrMov->format( 'Y-m-d H:i:s');
        $movimiento->comprobante = '/storage/'.'rec_'.$recibo->id.'/'.$file->getClientOriginalName();
        $cuenta->movimientos()->save($movimiento);

        if($recibo->reciboheader != null){
          $reciboheader = $recibo->reciboheader;
          $reciboheader->saldo = $reciboheader->saldo + $movimiento->ingreso;
          $reciboheader->save();
        }

        $cuenta->saldo += $movimiento->ingreso;
        $cuenta->save();

        $recalculate = Cuentamovimiento::where('cuenta_id','=',$cuenta->id)->where('fecMov','>=',$hrMov)->orderBy('fecMov','desc')->orderBy('id','desc')->get();
        $saldo = $cuenta->saldo;
        foreach($recalculate as $item){
          $item->saldo = $saldo;
          $item->save();
          $saldo += ($item->egreso - $item->ingreso);
        }

        $pdf = PDF::loadView('_pdf.recibo', compact('recibo'));
        return $pdf->download('invoice.pdf');
        /*if($request->backTo === 'vivienda'){
          return redirect()->route('vivienda.show',['id' => $recibo->vivienda->id]);
        }
        else{
          return redirect()->route('recibosHeader.show',['id' => $reciboheader->id]);
        }*/

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

    public function pdf()
    {
      $pdf = PDF::loadView('table');
      return $pdf->download('invoice.pdf');
    }
}
