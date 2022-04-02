<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cuota;
use App\Vivienda;
use App\CuotaVivienda;
use App\Recibos;
use App\Reciboheader;
use Mail;
use App\AvisoMail;
use Illuminate\Support\Facades\Auth;
use DB;

class CuotasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      Auth::user()->authorizeRoles(['Administrador','Residente']);
      $cuotas = Cuota::where('estado',1)->where('periodicidad','!=',null)->where('descripcion','like','%'.$request['descripcion'].'%')->paginate(10);
      switch(Auth::user()->profile->descripcion){
        case 'Administrador':
          return view('cuotas.index')->with('cuotas',$cuotas);
        break;
        case 'Residente':
          return view('profiles.residente.cuotas.index')->with('cuotas',$cuotas);
        break;
      }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      Auth::user()->authorizeRoles(['Administrador']);
        $viviendas = Vivienda::where('estado',1)->get();
        return view('cuotas.create')->with('viviendas',$viviendas);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      Auth::user()->authorizeRoles(['Administrador']);
      // validate form data
      $this->validate($request,[
          'descripcion' => 'required|min:3|max:30',
          'clave' => 'required|min:3|max:10',
          'importe' => 'required',
          'fecPago' => 'required',
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
      $cuota->clave = $request->clave;
      $cuota->importe = preg_replace('/[\$,]/', '', $request->importe);
      $cuota->fecPago = date( "Y-m-d", strtotime( $request->fecPago ) );
      $cuota->periodoGracia = $request->periodoGracia;
      $cuota->multaImporte = preg_replace('/[\$,]/', '', $request->multaImporte);
      if($request->chkRpt === "on")
      {
        $cuota->periodicidad = $request->periodicidad;
        $cuota->nPeriodos = $request->nPeriodos;
      }
      $cuota->estado = 1;
      //Redirect if successfull
      if($cuota->save()){
        $viviendas = $request->selected;
        //dd($viviendas);
        foreach($viviendas as $vivienda){
            $oVivienda = Vivienda::findOrFail($vivienda);
            $cuotavivienda = new CuotaVivienda();
            $cuotavivienda->vivienda_id = $vivienda;
            $cuota->viviendas()->save($cuotavivienda);
        }
        return redirect()->route('cuotas.index',['id' => $cuota->id]);
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
      Auth::user()->authorizeRoles(['Administrador','Residente']);
      $cuota = Cuota::findOrFail($id);
      $cuotas = Cuota::where('estado',1)->paginate(10);
      switch(Auth::user()->profile->descripcion){
        case 'Administrador':
          return view('cuotas.show')->with(['selected'=>$cuota,'cuotas'=>$cuotas] );
        break;
        case 'Residente':
          return view('profiles.residente.cuotas.show')->with(['selected'=>$cuota,'cuotas'=>$cuotas] );
        break;
      }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      Auth::user()->authorizeRoles(['Administrador']);
      $cuota = Cuota::findOrFail($id);
      $viviendas = Vivienda::where('estado',1)->get();

      $selected = array();
      foreach($viviendas as $vivienda){
        $checked = '';
        foreach($cuota->viviendas as $current){
            if($vivienda->id == $current->vivienda->id){
              $checked = 'checked';
              break;
            }
        }
        array_push($selected,['checked'=>$checked,'vivienda'=>$vivienda]);
      }
      return view('cuotas.edit')->with(['cuota'=>$cuota,'items'=>$selected] );
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
      Auth::user()->authorizeRoles(['Administrador']);
      $this->validate($request,[
          'descripcion' => 'required|min:3|max:30',
          'clave' => 'required|min:3|max:10',
          'importe' => 'required',
          'fecPago' => 'required',

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
        $cuota->multaImporte = preg_replace('/[\$,]/', '', $request->multaImporte);
        if($request->chkRpt === "on")
        {
          $cuota->periodicidad = $request->periodicidad;
          $cuota->nPeriodos = $request->nPeriodos;
        }
        //Redirect if successfull
        if($cuota->save()){
          $itemsSelected = $request->selected;
          $viviendas = Vivienda::where('estado',1)->get();
          foreach($viviendas as $vivienda){
              $cuotavivienda = CuotaVivienda::where('cuota_id',$cuota->id)->where('vivienda_id',$vivienda->id)->first();
              if($cuotavivienda === null && in_array($vivienda->id,$itemsSelected)){
                $cuotavivienda = new CuotaVivienda();
                $cuotavivienda->vivienda_id = $vivienda->id;
                $cuota->viviendas()->save($cuotavivienda);
              }
              if($cuotavivienda != null && !in_array($vivienda->id,$itemsSelected)){
                


                $cuotavivienda->delete();

              }

          }
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
      Auth::user()->authorizeRoles(['Administrador']);
      $cuota = Cuota::findOrFail($id);
      $cuota->estado = 0;
      if($cuota->save()){
        foreach($cuota->recibosHeader as $reciboHeader){
          $reciboHeader->estado = 0;
          $reciboHeader->save();
          foreach($reciboHeader->recibos as $recibo){
            $recibo->estado = 0;
            $recibo->save();
          }

        }

          return redirect()->route('cuotas.index');
      }
    }
}
