<?php
namespace App\Factory;

use App\Boundary\OutputPort;

class OutputPortFactory {
    public static function makeFailResponse($errors){
        $outputPort = new OutputPort();
        $outputPort->success = false;
        $outputPort->errors = $errors;
        return $outputPort;
    }
}