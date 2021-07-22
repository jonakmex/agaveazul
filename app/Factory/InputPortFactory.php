<?php
namespace App\Factory;

use App\Boundary\Input\CreateUnitInputPort;

class InputPortFactory {
    public static function make(string $inputPortName,$params){
        if("CreateUnitInputPort" === $inputPortName)
            return InputPortFactory::makeCreateUnitInputPort($params);
    }

    private static function makeCreateUnitInputPort($params){
        $inputPort = new CreateUnitInputPort;
        $inputPort->description = $params["description"];
        return $inputPort;
    }
}