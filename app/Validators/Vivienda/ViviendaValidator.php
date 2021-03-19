<?php
namespace App\Validators\Vivienda;

use App\Validators\CommonValidator;

class ViviendaValidator 
{
    public static function validateDescripcion($description)
    {
        $error = CommonValidator::validateText($description,3,50,false);

        if($error != null)
            return array_map('descripcion',$error);

        return null;
    }

    public static function validateClave($clave)
    {
        $error = CommonValidator::validateText($clave,1,10,false);

        if($error != null)
            return array_map('clave',$error);

        return null;
    }

    public static function validateReferencia($referencia)
    {
        $error = CommonValidator::validateText($referencia,1,30,false);

        if($error != null)
            return array_map('referencia',$error);

        return null;
    }
}