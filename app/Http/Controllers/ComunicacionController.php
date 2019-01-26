<?php

namespace App\Http\Controllers;
use App\Vivienda;
use Mail;
use App\AvisoMail;

use Illuminate\Http\Request;

class ComunicacionController extends Controller
{
    public function index(){
      $viviendas = Vivienda::where('estado',1)->get();
      return view('comunicacion.index')->with('viviendas',$viviendas);
    }

    public function send(Request $request){
      $this->validate($request,[
          'subject' => 'required',
          'compose' => 'required',
      ]);
      $viviendas = $request->selected;
      $subject = $request->subject;
      $compose = $request->compose;
      if(!is_array($viviendas)){
         return redirect()->route('comunicacion.index')->withErrors(['vivienda'=>'Debe Seleccionar una vivienda']);
      }
      $route = null;
      if($request->hasFile('attachment')){
        $file = $request->file('attachment');
        $request->file('attachment')->move(public_path(), 'Comunicado.'.$file->getClientOriginalExtension());
        $route = public_path().'/Comunicado.'.$file->getClientOriginalExtension();
      }

      $data = array('compose'=>$compose);
      foreach($viviendas as $vivienda){
        $oVivienda = Vivienda::findOrFail($vivienda);
        Mail::to($oVivienda->contactoPrincipal()->email)->queue(AvisoMail::newComunicado($subject,$data,$route));
      }

      /**/
      return redirect()->route('home');
    }
}
