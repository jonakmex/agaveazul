<?php

namespace App\Interactors\Validators;

class Validator 
{
    public static function mandatoryInBetween($value,$min = 1,$max = 1){
        $message = array();
        if($value == null)
            $message = array("message"=>"MSG_ERR_MIN","value"=>$value,"expected.min"=>$min,"expected.max"=>$max);
        else if(strlen($value) < $min)
            $message = array("message"=>"MSG_ERR_MIN","value"=>$value,"expected.min"=>$min,"expected.max"=>$max);
        else if(strlen($value) > $max)
            $message = array("message"=>"MSG_ERR_MAX","value"=>$value,"expected.min"=>$max,"expected.max"=>$max);
        
        return $message;
    }
}
 