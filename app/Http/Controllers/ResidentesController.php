<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vivienda;
use App\Residente;
use App\Service\Mapper\ResidenteMapper;
use App\Service\ContactoService;
use \DB;
class ResidentesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.residentes.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.residentes.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      // validate form data
      $this->validate($request,[
          'vivienda_id' => 'required',
          'nombre' => 'required|min:3|max:100',
          'telefono' => 'required|min:10|max:10',
          'email' => 'required|email',
          'tipo' => 'required|integer',
      ]);
      //Process de data and submit it
      $residente = new Residente();
      ResidenteMapper::map($residente,$request);

      $vivienda = Vivienda::findOrFail($request->vivienda_id);
      //Redirect if successfull
      if($vivienda->residentes()->save($residente)){
          if($residente->principal == 1){
            DB::table('residentes')
            ->where('vivienda_id', $vivienda->id)
            ->whereNotIn('id',[$residente->id])
            ->update(['principal' => 0]);
          }
          return redirect()->route('vivienda.show',['id'=>$request->vivienda_id]);
      }
      else
      {
          return redirect()->route('crearResidente',['id'=>$request->vivienda_id]);
      }
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
        $residente = Residente::findOrFail($id);
        return view('admin.residentes.edit')->with('residente',$residente);
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
      // validate form data
      $this->validate($request,[
          'nombre' => 'required|min:3|max:100',
          'telefono' => 'required|min:10|max:10',
          'email' => 'required|email',
          'tipo' => 'required|integer',

      ]);
      //Process de data and submit it
      $residente = Residente::findOrFail($id);
      ResidenteMapper::map($residente,$request);
      //Redirect if successfull
      if($residente->save()){
        if($residente->principal == 1){
          DB::table('residentes')
          ->where('vivienda_id', $residente->vivienda->id)
          ->whereNotIn('id',[$residente->id])
          ->update(['principal' => 0]);
        }
        return redirect()->route('vivienda.show',['id'=>$residente->vivienda->id]);
      }
      else
      {
          return redirect()->route('residentes.edit',['id'=>$id]);
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $residente = Residente::findOrFail($id);
      $residente->estado = 0;
      $vivienda = $residente->vivienda;
      if($residente->save()){
          return redirect()->route('vivienda.show',['id'=>$vivienda->id]);
      }
    }

    public function generarToken(Request $request)
    {
      $residente = Residente::findOrFail($request->id);
      ContactoService::crearTokenRegistro($residente);
      return redirect()->route('vivienda.show',['id'=>$residente->vivienda->id]);
    }
}
