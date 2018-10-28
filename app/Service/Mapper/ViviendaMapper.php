<?php
namespace App\Service\Mapper;
use Illuminate\Http\Request;
use App\Vivienda;

class ViviendaMapper
{
  public static function map(Vivienda $vivienda,Request $request)
  {
    $vivienda->descripcion = $request->descripcion;
    $vivienda->clave = $request->clave;

  }
}
