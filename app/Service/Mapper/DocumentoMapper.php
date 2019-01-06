<?php
namespace App\Service\Mapper;
use Illuminate\Http\Request;
use App\Documento;

class DocumentoMapper
{
  public static function map(Documento $documento,Request $request)
  {
    $documento->titulo = $request->titulo;
    $documento->descripcion = $request->descripcion;
    if($request->hasFile('archivo')){
        $documento->archivo = $request->file('archivo')->getClientOriginalName();
    }

  }
}
