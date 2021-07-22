<?php
namespace App\Factory;


class InputPortFactory {
    public static function make(string $inputPortName,$params = null){
        $inputPort = new $inputPortName;
        if($params != null)
            InputPortFactory::mapArrayToObject($inputPort,$params);

        return $inputPort;
    }


    private static function mapArrayToObject($object,$params){
        foreach($params as $key => $value){
            $object->{$key} = $value;
        }
    }
}