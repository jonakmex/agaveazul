<?php
namespace App\Interactor\Vivienda;

use App\Interactor\Interactor;
use App\DS\Request;
use App\DS\Response\Vivienda\CrearViviendaResponse;
use App\Validators\Validator;
use App\Factories\ValidatorFactory;
use App\Factories\ResponseFactory;
use App\Vivienda;

class CrearViviendaInteractor implements Interactor{
    
    public function execute(Request $request){
        $validator = ValidatorFactory::make('Vivienda\CrearViviendaValidator');
        $validator->validate($request);
        $vivienda = new Vivienda();
        $vivienda->descripcion = $request->descripcion;
        $vivienda->clave = $request->clave;
        $vivienda->estado = 1;
        $vivienda->referencia = $request->referencia;
        $vivienda->save();
        return ResponseFactory::make('Vivienda\CrearViviendaResponse',$vivienda->toArray());
    } 
}