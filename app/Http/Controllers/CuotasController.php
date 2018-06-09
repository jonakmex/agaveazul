<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cuota;
class CuotasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $cuotas = Cuota::where('estado',1)->paginate(10);
      return view('admin.cuotas.index')->with('cuotas',$cuotas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.cuotas.create');
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
          'descripcion' => 'required|min:3|max:30',
          'importe' => 'required',
          'fecPago' => 'required',
          'periodoGracia' => 'required',
      ]);

      if($request->chkRpt === "on")
      {
        $this->validate($request,[
            'periodicidad' => 'required',
            'nPeriodos' => 'required'
        ]);
      }
      //Process de data and submit it
      $cuota = new Cuota();

      $cuota->descripcion = $request->descripcion;
      $cuota->importe = preg_replace('/[\$,]/', '', $request->importe);
      $cuota->fecPago = date( "Y-m-d", strtotime( $request->fecPago ) );
      $cuota->periodoGracia = $request->periodoGracia;
      if($request->chkRpt === "on")
      {
        $cuota->periodicidad = $request->periodicidad;
        $cuota->nPeriodos = $request->nPeriodos;
      }
      $cuota->estado = 1;
      //Redirect if successfull
      if($cuota->save()){
          return redirect()->route('cuotas.show',['id' => $cuota->id]);
      }
      else{
          return redirect()->route('cuotas.create');
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
      $cuota = Cuota::findOrFail($id);
      $cuotas = Cuota::where('estado',1)->paginate(10);
      return view('admin.cuotas.show')->with(['selected'=>$cuota,'cuotas'=>$cuotas] );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $cuota = Cuota::findOrFail($id);
      return view('admin.cuotas.edit')->with(['cuota'=>$cuota] );
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
      $this->validate($request,[
          'descripcion' => 'required|min:3|max:30',
          'importe' => 'required',
          'fecPago' => 'required',
          'periodoGracia' => 'required',
      ]);

      if($request->chkRpt === "on")
      {
        $this->validate($request,[
            'periodicidad' => 'required',
            'nPeriodos' => 'required'
        ]);
      }


        $cuota = Cuota::findOrFail($id);
        $cuota->descripcion = $request->descripcion;
        $cuota->importe = preg_replace('/[\$,]/', '', $request->importe);
        $cuota->fecPago = date( "Y-m-d", strtotime( $request->fecPago ) );
        $cuota->periodoGracia = $request->periodoGracia;
        if($request->chkRpt === "on")
        {
          $cuota->periodicidad = $request->periodicidad;
          $cuota->nPeriodos = $request->nPeriodos;
        }
        //Redirect if successfull
        if($cuota->save()){
            return redirect()->route('cuotas.show',['id' => $cuota->id]);
        }
        else{
            return redirect()->route('cuotas.edit')->with('id',$cuota->id);
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
      $cuota = Cuota::findOrFail($id);
      $cuota->estado = 0;
      if($cuota->save()){
          return redirect()->route('cuotas.index');
      }
    }
}
