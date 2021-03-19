<?php
namespace App\Interactor\Vivienda;

use App\Interactor\Interactor;
use App\DS\Request;
use App\DS\Response\Vivienda\ActualizarViviendaResponse;
use App\Vivienda;

class ActualizarViviendaInteractor implements Interactor
{
    public function execute(Request $request){
        $vivienda = Vivienda::find($request->id);
        $vivienda->descripcion = $request->descripcion;
        $vivienda->clave = $request->clave;
        $vivienda->estado = $request->estado;
        $vivienda->referencia = $request->referencia;
        return new ActualizarViviendaResponse();
    }
}