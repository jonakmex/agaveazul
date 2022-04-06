<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\RegistroBanco;
use App\Vivienda;
use Carbon\Carbon;

class RegistroBancoController extends Controller
{
    public function index(){
        Auth::user()->authorizeRoles(['Administrador']);
        $today = new \DateTime('now');
        return view('diariobanco.index',["fechaInicio"=>$today->format('Y-m-d'),"fechaFin"=>$today->format('Y-m-d')]);
    }

    public function store(Request $request)
    {
        Auth::user()->authorizeRoles(['Administrador']);
        $this->validate($request,[
            'diariobanco' => 'mimes:txt',
        ]);
        if($request->file('diariobanco') != null)
            RegistroBancoController::saveFile($request->file('diariobanco'));

        $records = RegistroBancoController::diarioBancos($request);
        return view('diariobanco.show',["records"=>$records,"fechaInicio"=>$request->fechaInicio,"fechaFin"=>$request->fechaFin]);
    }

    public function applyTransaction(Request $request){

        foreach($request->selected as $id){
            $rec = RegistroBanco::findOrFail($id);
            $rec->estado = 1;
            $rec->save();
        }

        $records = RegistroBancoController::diarioBancos($request);
        return view('diariobanco.show',["records"=>$records,"fechaInicio"=>$request->fechaInicio,"fechaFin"=>$request->fechaFin]);
    }


private static function saveFile($file){
    $file = file_get_contents($file);
        $stringArr = explode("\n", $file);
        $records = [];
        foreach($stringArr as $row){
            $record = explode("|", $row);
            
            if(count($record) == 15 && is_numeric($record[6])){
                $clave = "$record[0].$record[1].$record[2].$record[3].$record[4].$record[5].$record[6].$record[7].$record[8].$record[9].$record[10].$record[11].$record[12].$record[13]";
                $rec = RegistroBanco::where('clave','=',$clave)->first();
                if($rec == null){
                    $rec = new RegistroBanco;
                    $rec->clave = $clave;
                    $rec->estado=0;
                }
                
                $rec->tipo = $record[0];
                $rec->moneda = $record[1];
                $rec->uso_futuro = $record[2];
                $rec->cuenta = $record[3];
                $rec->fecha = $record[4];
                $rec->referencia = $record[5];
                $rec->importe =  (double) $record[6];
                if('Cargo' === $record[7])
                    $rec->importe *= -1;
                $rec->tipo_transaccion = $record[7];
                $rec->saldo = (double) $record[8];
                $rec->transaccion = $record[9];
                $rec->leyenda_1 = $record[10];
                $rec->leyenda_2 = $record[11];
                $rec->informacion_adicional_spei = $record[13];
                $rec->save();
            }
        }
}

    private static function diarioBancos($request){
        $records = [];
        $recs = RegistroBanco::whereDate('fecha','>=',Carbon::parse($request->fechaInicio)->toDateString())
                ->whereDate('fecha','<=',Carbon::parse($request->fechaFin)->toDateString())
                ->get();
        $vivienda = null;
        foreach($recs as $rec){
            
                //attempt 1 by reference
                
                if('Abono' == $rec->tipo_transaccion)
                    $vivienda = RegistroBancoController::findViviendaByReference($rec->leyenda_1);
                
                // attempt 2 by cents
                $splitted = explode('.',strval($rec->importe));
                
                if($vivienda == null && 'Abono' == $rec->tipo_transaccion && count($splitted) == 2){
                    $vivienda = RegistroBancoController::findViviendaByDescripcion("$splitted[1]");
                }

                if($vivienda == null && 'Abono' == $rec->tipo_transaccion)
                {
                    $existeCasaDescripcion = stripos($rec->informacion_adicional_spei,"casa ");
                    if($existeCasaDescripcion === false){
                        info("Casa not found");
                    }
                    else{
                        $casa = substr($rec->informacion_adicional_spei,$existeCasaDescripcion,strlen("casa xx")); 
                        $vivienda = RegistroBancoController::findViviendaByDescripcion($casa);
                    }     
                }
            
            $checked = $rec->estado != 0 ? "checked" : "";
            array_push($records,["diario"=>$rec,"vivienda"=>$vivienda,"checked"=>$checked]);
        }
        return $records;
    }

    private static function findViviendaByReference($reference){
        if(strlen($reference) === 4){
            return $vivienda = Vivienda::where('referencia','=',$reference)->first();
        }
        return null;
    }

    private static function findViviendaByDescripcion($descripcion){
        return Vivienda::where('descripcion','like',"%".strtolower($descripcion)."%")->first();
    }
}
