<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vivienda;
use App\Residente;
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
          'nombre' => 'required|min:3|max:30',
          'telefono' => 'required|min:10|max:10',
          'email' => 'required|email'
      ]);
      //Process de data and submit it
      $residente = new Residente();

      $residente->nombre = $request->nombre;
      $residente->telefono = $request->telefono;
      $residente->email = $request->email;
      $residente->estado = 1;

      $vivienda = Vivienda::findOrFail($request->vivienda_id);
      //Redirect if successfull
      if($vivienda->residentes()->save($residente)){
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
          'nombre' => 'required|min:3|max:30',
          'telefono' => 'required|min:10|max:10',
          'email' => 'required|email'
      ]);
      //Process de data and submit it
      $residente = Residente::findOrFail($id);

      $residente->nombre = $request->nombre;
      $residente->telefono = $request->telefono;
      $residente->email = $request->email;
      $vivienda = $residente->vivienda;
      //Redirect if successfull
      if($residente->save()){
          return redirect()->route('vivienda.show',['id'=>$vivienda->id]);
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
}
