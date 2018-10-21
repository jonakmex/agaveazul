<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Recibos;
use App\Cuenta;
class RecibosController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $cuentas = Cuenta::where('estado',1)->paginate(10);
      return view('admin.recibos.show')->with('cuentas',$cuentas);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.recibos.edit');
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

    public function payAndBackToVivienda($id)
    {
      $recibo = Recibos::findOrFail($id);
      $cuentas = Cuenta::where('estado',1)->paginate(10);
      $form = [
        'recibo'=>$recibo,
        'cuentas'=>$cuentas,
        'backTo'=>'vivienda'
      ];
      return view('admin.pagos.create')->with('form',$form);
    }

    public function payAndBackToRecibos($id)
    {
      $recibo = Recibos::findOrFail($id);
      $cuentas = Cuenta::where('estado',1)->paginate(10);
      $form = [
        'recibo'=>$recibo,
        'cuentas'=>$cuentas,
        'backTo'=>'recibos'
      ];
      return view('admin.pagos.create')->with('form',$form);
    }
}
