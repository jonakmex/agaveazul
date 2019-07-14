<?php
namespace App\Service;
use App\DTO\CrearComunicadoIn;
use App\DTO\EditarComunicadoIn;
use App\Comunicado;
use App\BusinessException;
use \Datetime;

class ComunicadoService
{
    public static function crear(CrearComunicadoIn $crearComunicadoIn)
    {
      $comunicado = new Comunicado();
      $comunicado->descripcion = $crearComunicadoIn->descripcion;
      $comunicado->documento = $crearComunicadoIn->documento;
      $comunicado->estado = 1;
      $comunicado->save();
    }

    public static function editar(EditarComunicadoIn $editarComunicadoIn)
    {
      $comunicado = $editarComunicadoIn->current;
      $comunicado->descripcion = $editarComunicadoIn->descripcion;
      $comunicado->documento = $editarComunicadoIn->documento;
      $comunicado->save();
    }
}
