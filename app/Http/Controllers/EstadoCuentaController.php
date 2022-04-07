<?php

namespace App\Http\Controllers;
use App\Vivienda;
use Mail;
use PDF;
use App\AvisoMail;
use DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Recibos;

class EstadoCuentaController extends Controller
{
    public function index(){
      $viviendas = Vivienda::where('estado',1)->get();
      $today = new \DateTime('now');
      return view('estadocuenta.index',['viviendas'=>$viviendas,'fecha'=>$today->format('Y-m-d')]);
    }

    public function send(Request $request){
     
      $viviendaIds = $request->selected;
      if(!is_array($viviendaIds)){
         return redirect()->route('estadocuenta.index')->withErrors(['vivienda'=>'Debe Seleccionar una vivienda']);
      }

      foreach($viviendaIds as $id){
        $vivienda = Vivienda::findOrFail($id);
        
        $recibos = Recibos::where('vivienda_id',$id)->where('estado','=',1)->whereDate('fecLimite','<=',Carbon::parse($request->fecha))->orderBy('fecLimite','desc')->get();
        $total = 0;
        foreach($recibos as $recibo){
          $total += $recibo->importe;
        }
        $fecha = $request->fecha;
        $data = array('nombre'=>$vivienda->contactoPrincipal()->email);
        $pdf = PDF::loadView('_pdf.edocta', compact("recibos","total","fecha"));

        \Storage::disk('public')->put("estadocuenta_".$request->fecha.'.pdf', $pdf->output());
        $file = storage_path('app/public/'."estadocuenta_".$request->fecha.'.pdf');

        Mail::to($vivienda->contactoPrincipal()->email)
        ->queue(AvisoMail::newAvisoEstadoDeCuenta($data,$file));
      }

      return redirect()->route('estadocuenta.index');
    }
}
