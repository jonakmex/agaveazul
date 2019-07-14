<?php
namespace App\Service\Mapper;

use App\DTO\CrearComunicadoIn;
use App\DTO\EditarComunicadoIn;
use Illuminate\Http\Request;
use App\Comunicado;
use \DateTime;
use Storage;
use File;

class ComunicadoMapper
{
    public static function getCrearComunicadoIn(Request $request){
        $crearComunicadoIn = new CrearComunicadoIn();
        $crearComunicadoIn->descripcion = $request->descripcion;
        if($request->hasFile('documento')){
          $file = $request->file('documento');
          Storage::disk('public')->put('comunicados/'.$file->getClientOriginalName(),File::get($file));
          $crearComunicadoIn->documento = '/comunicados/'.$file->getClientOriginalName();
        }
        return $crearComunicadoIn;
    }

    public static function getEditarComunicadoIn(Comunicado $comunicado,Request $request){
        $editarComunicadoIn = new EditarComunicadoIn();
        $editarComunicadoIn->current = $comunicado;
        $editarComunicadoIn->descripcion = $request->descripcion;
        $editarComunicadoIn->estado = $request->estado;
        if($request->hasFile('documento')){
          $file = $request->file('documento');
          Storage::disk('public')->put('comunicados/'.$file->getClientOriginalName(),File::get($file));
          $editarComunicadoIn->documento = '/comunicados/'.$file->getClientOriginalName();
        }
        else{
          $editarComunicadoIn->documento =  $comunicado->documento;
        }
        return $editarComunicadoIn;
    }
}
