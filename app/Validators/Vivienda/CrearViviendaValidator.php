<?php
namespace App\Validators\Vivienda;
use App\Validators\Validator;
use App\Validators\Vivienda\ViviendaValidator;
use App\Exception\BusinessException;
use App\DS\Request;


class CrearViviendaValidator implements Validator
{
    public function validate(Request $request)
    {
        $errors = array();
        $error = ViviendaValidator::validateDescripcion($request->descripcion);
        if($error != null)
            array_push($errors,$error);
        
        $error = ViviendaValidator::validateClave($request->clave);
        if($error != null)
            array_push($errors,$error);

        $error = ViviendaValidator::validateReferencia($request->referencia);
        if($error != null)
            array_push($errors,$error);

        if(count($errors) > 0)
            throw new BusinessException($errors);
    }
}