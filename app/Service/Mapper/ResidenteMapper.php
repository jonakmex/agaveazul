<?php
namespace App\Service\Mapper;
use Illuminate\Http\Request;
use App\Residente;

class ResidenteMapper
{
  public static function map(Residente $residente,Request $request)
  {
    $residente->nombre = $request->nombre;
    $residente->telefono = $request->telefono;
    $residente->email = $request->email;
    $residente->tipo = $request->tipo;
    $residente->principal = $request->chkPrincipal === "on" ? 1 : 0;

  }
}
