<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reciboheader;
use App\Exports\RecibosExport;
use App\Cuenta;
use Illuminate\Support\Facades\Auth;

class RecibosHeaderController extends Controller
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
      info('Running Recibos Header Show...');
      Auth::user()->authorizeRoles(['Administrador']);
      // Use the model to get one record from DB
      $reciboHeader = Reciboheader::findOrFail($id);
      $cuentas = Cuenta::where('estado',1)->get();
      info('Cuentas:'.$cuentas->count());
      //Show the view and pass the record
      info('Returning view.');
      return view('recibos.header.show')->with(['reciboHeader'=>$reciboHeader,'cuentas'=>$cuentas]);
    }

    public function exportar($id)
    {
      Auth::user()->authorizeRoles(['Administrador']);
      $reciboHeader = Reciboheader::findOrFail($id);
      $name = $reciboHeader->cuota->descripcion.'_'.$reciboHeader->descripcion;
      return (new RecibosExport($id))->download("recibos_$name.xlsx");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
