<?php
namespace App\Validators;

class CommonValidator 
{
    public static function validateText($value,$min,$max,$optional = true){
        
        if(!$optional && $value == null)
            return 'MSG_ERR_001';
        
        if($value != null && strlen($value)<$min)
            return 'MSG_ERR_002';

        if($value != null && strlen($value)>$max)
            return 'MSG_ERR_003';

        return null;
    }
}