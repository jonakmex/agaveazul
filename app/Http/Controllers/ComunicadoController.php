<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comunicado;
use App\DTO\CrearComunicadoIn;
use App\DTO\EditarComunicadoIn;
use App\Service\Mapper\ComunicadoMapper;
use App\Service\ComunicadoService;
use Illuminate\Support\Facades\Auth;
use Storage;
use File;

class ComunicadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      Auth::user()->authorizeRoles(['Administrador','Residente','Operador']);
      $comunicados = Comunicado::where('estado',1)->paginate(10);

      switch(Auth::user()->profile->descripcion){
        case 'Administrador':
        return view('comunicados.index')->with('comunicados',$comunicados);
        break;
        case 'Residente':
          return view('profiles.residente.comunicados.index')->with(['comunicados'=>$comunicados]);
        break;
        case 'Operador':
          return view('profiles.operador.comunicados.index')->with(['comunicados'=>$comunicados]);
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
        return view('comunicados.create');
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
        
        
      $crearComunicadoIn = ComunicadoMapper::getCrearComunicadoIn($request);
      try{
          ComunicadoService::crear($crearComunicadoIn);
          return redirect()->route('comunicados.index');
      }
      catch(BusinessException $e){
          return redirect()->route('comunicados.create');
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
        $comunicado = Comunicado::findOrFail($id);
        switch(Auth::user()->profile->descripcion){
            case 'Administrador':
              return view('comunicados.show')->with(['comunicado'=>$comunicado]);
            break;
            case 'Residente':
              //return view('profiles.residente.vivienda.show')->with(['vivienda'=>$vivienda,'recibos'=>$recibos,'cuentas'=>$cuentas]);
            break;
            case 'Operador':
              //return view('profiles.operador.vivienda.show')->with(['vivienda'=>$vivienda,'recibos'=>$recibos,'cuentas'=>$cuentas]);
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
      $comunicado= Comunicado::findOrFail($id);
      //Show the view and pass the record
      return view('comunicados.edit')->with('comunicado',$comunicado);
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
            'descripcion' => 'required|min:1|max:30',
            
        ]);
        
        $comunicado = Comunicado::find($id);
        $editarComunicadoIn = ComunicadoMapper::getEditarComunicadoIn($comunicado,$request);
        try{
            ComunicadoService::editar($editarComunicadoIn);
            return redirect()->route('comunicados.index');
        }
        catch(BusinessException $e){
            return redirect()->route('comunicados.create');
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
      $comunicado = Comunicado::findOrFail($id);
      $comunicado->estado = 0;
      if($comunicado->save()){
          return redirect()->route('comunicados.index');
      }
    }

    public function getFile($id){
      Auth::user()->authorizeRoles(['Administrador','Residente']);
      $comunicado = Comunicado::findOrFail($id);
      return Storage::disk('public')->download($comunicado->documento);
    }
}
