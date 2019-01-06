<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Documento;
use App\Service\DocumentoService;
use App\Service\Mapper\DocumentoMapper;
use App\Exception\BusinessException;
use Illuminate\Support\Facades\Auth;
use Storage;
use File;

class DocumentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Auth::user()->authorizeRoles(['Administrador','Residente']);
        $documentos = Documento::where('estado',1)->paginate(10);
        if(Auth::user()->profile->descripcion ==='Administrador'){
          return view('documento.index')->with('documentos',$documentos);
        }
        else if(Auth::user()->profile->descripcion ==='Residente'){
          //return view('profiles.residente.documentos.index')->with('documentos',$documentos);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      //Auth::user()->authorizeRoles(['Administrador']);
      //return view('documento.create');
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
          'titulo' => 'required|min:1|max:100',
          'archivo' => 'required'
      ]);
      //Process de data and submit it
      $documento = Documento::find($request->id);
      if($documento === null){
          $documento = new Documento();
      }
      DocumentoMapper::map($documento,$request);

      try{
        DocumentoService::save($documento);
        Storage::disk('public')->put($documento->dir().'/'.$request->file('archivo')->getClientOriginalName(),File::get($request->file('archivo')));
        return redirect()->route('documento.index');
      }
      catch(BusinessException $e){
        return redirect()->route('documento.create');
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
      Auth::user()->authorizeRoles(['Administrador']);
      // validate form data
      $this->validate($request,[
          'titulo' => 'required|min:1|max:100'
      ]);
      //Process de data and submit it
      $documento = Documento::findOrFail($id);
      DocumentoMapper::map($documento,$request);

      //Redirect if successfull
      if($documento->save()){
        if($request->hasFile('archivo')){
          Storage::disk('public')->put($documento->dir().'/'.$request->file('archivo')->getClientOriginalName(),File::get($request->file('archivo')));
        }
          return redirect()->route('documento.index');
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
      $documento = Documento::findOrFail($id);
      $documento->estado = 0;
      if($documento->save()){
          return redirect()->route('documento.index');
      }
    }
}
