<?php

namespace App\Http\Controllers;
use App\Vivienda;
use Mail;
use App\AvisoMail;
use DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

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

      foreach($viviendas as $vivienda){
        $compose = $request->compose;
        $oVivienda = Vivienda::findOrFail($vivienda);
        $compose = str_replace("#nombre#",$oVivienda->contactoPrincipal()->nombre,$compose);
        $compose = str_replace("#saldo#",$oVivienda->saldo(),$compose);
        $compose = str_replace("#casa#",$oVivienda->descripcion,$compose);
        $compose = str_replace("#referencia#",$oVivienda->referencia,$compose);
        $data = array('compose'=>$compose);
        Mail::to($oVivienda->contactoPrincipal()->email)
        ->queue(AvisoMail::newComunicado($subject,$data,$route));
      }
      
      return redirect()->route('home');
    }

    
  

    public function mora(){
      Auth::user()->authorizeRoles(['Administrador','Residente','Operador']);
      Vivienda::whereIn('id',function($query){

      });
      $morosos = DB::table('vivienda')
                ->select('vivienda.id','vivienda.descripcion', DB::raw('count(recibos.id) as recs'),DB::raw('sum(recibos.importe) as total'))
                ->join('recibos', 'recibos.vivienda_id', '=', 'vivienda.id')
                ->join('reciboheader', 'reciboheader.id', '=', 'recibos.reciboheader_id')
                ->join('cuotas', 'cuotas.id', '=', 'reciboheader.cuota_id')
                ->where('vivienda.estado',1)
                ->where('cuotas.estado',1)
                ->where('recibos.fecLimite','<=',Carbon::today())
                ->where('recibos.estado','!=',2)
                ->groupBy('vivienda.id','vivienda.descripcion')
                ->orderBy('vivienda.descripcion')
                ->get();
      switch(Auth::user()->profile->descripcion){
        case 'Administrador':
          return view('comunicacion.mora')->with('viviendas',$morosos);
        break;
        case 'Residente':
          return view('profiles.residente.reportes.mora')->with('viviendas',$morosos);
        break;
        case 'Operador':
          return view('profiles.operador.reportes.mora')->with('viviendas',$morosos);
        break;
      }
    }
}
