<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reciboheader;
use App\Exports\RecibosExport;

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
      // Use the model to get one record from DB
      $reciboHeader = Reciboheader::findOrFail($id);
      //Show the view and pass the record
      return view('admin.recibosheader.show')->with('reciboHeader',$reciboHeader);
    }

    public function exportar($id)
    {
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
