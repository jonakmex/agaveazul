<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vivienda;
use App\Recibos;
use App\Cuenta;
use App\Cuota;
use App\Service\ViviendaService;
use App\Service\Mapper\ViviendaMapper;
use App\Exception\BusinessException;
use Illuminate\Support\Facades\Auth;
use PDF;
use Mail;
use App\AvisoMail;

class ViviendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    { 
        Auth::user()->authorizeRoles(['Administrador','Operador']);
        $viviendas = Vivienda::where('estado',1)->where('descripcion','like','%'.$request['descripcion'].'%')->paginate(5);

        switch(Auth::user()->profile->descripcion){
          case 'Administrador':
          return view('vivienda.index')->with('viviendas',$viviendas);
          break;
          case 'Operador':
          return view('profiles.operador.vivienda.index')->with('viviendas',$viviendas);
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
        return view('vivienda.create');
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
      Auth::user()->authorizeRoles(['Administrador']);
      $this->validate($request,[
          'descripcion' => 'required|min:1|max:30',
          'clave' => 'required|min:1|max:10',
          'referencia' => 'required|min:1|max:30'
      ]);
      //Process de data and submit it
      $vivienda = Vivienda::find($request->id);
      if($vivienda === null){
          $vivienda = new Vivienda();
      }
      ViviendaMapper::map($vivienda,$request);

      try{
        ViviendaService::save($vivienda);
        return redirect()->route('vivienda.index');
      }
      catch(BusinessException $e){
        return redirect()->route('vivienda.create');
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
      Auth::user()->authorizeRoles(['Administrador','Residente','Operador']);

      // Use the model to get one record from DB
      $vivienda = Vivienda::findOrFail($id);
      $recibos = Recibos::where('vivienda_id',$id)->whereIn('estado',[1,2])->orderBy('fecLimite','desc')->paginate(10);
      $cuentas = Cuenta::where('estado',1)->get();
      //Show the view and pass the record
      switch(Auth::user()->profile->descripcion){
        case 'Administrador':
          return view('vivienda.show')->with(['vivienda'=>$vivienda,'recibos'=>$recibos,'cuentas'=>$cuentas]);
        break;
        case 'Residente':
          return view('profiles.residente.vivienda.show')->with(['vivienda'=>$vivienda,'recibos'=>$recibos,'cuentas'=>$cuentas]);
        break;
        case 'Operador':
          return view('profiles.operador.vivienda.show')->with(['vivienda'=>$vivienda,'recibos'=>$recibos,'cuentas'=>$cuentas]);
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
      // Use the model to get one record from DB
      $vivienda = Vivienda::findOrFail($id);
      //Show the view and pass the record
      return view('vivienda.edit')->with('vivienda',$vivienda);
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
      // validate form data
      $this->validate($request,[
          'descripcion' => 'required|min:1|max:30',
          'clave' => 'required|min:1|max:10',
          'referencia' => 'required|min:1|max:30'
      ]);
      //Process de data and submit it
      $vivienda = Vivienda::findOrFail($id);
      ViviendaMapper::map($vivienda,$request);

      //Redirect if successfull
      if($vivienda->save()){
          return redirect()->route('vivienda.index');
      }
      else{
          return redirect()->route('vivienda.edit');
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
      $vivienda = Vivienda::findOrFail($id);
      $vivienda->estado = 0;
      if($vivienda->save()){
          return redirect()->route('vivienda.index');
      }
    }

    public function crearResidente($id)
    {
      Auth::user()->authorizeRoles(['Administrador']);
      $vivienda = Vivienda::findOrFail($id);
      return view('admin.residentes.create')->with('vivienda',$vivienda);
    }

    public function generarRecibo(Request $request){
      $vivienda = Vivienda::findOrFail($request->vivienda_id);
      $cuota = Cuota::findOrFail($request->cuota_id);
      ViviendaService::generarSiguienteRecibo($vivienda,$cuota);
      return redirect()->route('vivienda.show',$vivienda->id);
    }

    public function edocta($id){
      $vivienda = Vivienda::findOrFail($id);
      $recibos = Recibos::where('vivienda_id',$id)->where('estado','=',1)->orderBy('fecLimite','desc')->get();
      $total = 0;
      foreach($recibos as $recibo){
        $total += $recibo->importe;
      }

      switch(Auth::user()->profile->descripcion){
        case 'Administrador':
          return view('vivienda.edocta',['vivienda'=>$vivienda,'recibos'=>$recibos,'total'=>$total]);
        break;
        case 'Residente':
          return view('profiles.residente.vivienda.edocta',['vivienda'=>$vivienda,'recibos'=>$recibos,'total'=>$total]);
        break;
      }

      return view('vivienda.edocta',['vivienda'=>$vivienda,'recibos'=>$recibos,'total'=>$total]);
    }
}
