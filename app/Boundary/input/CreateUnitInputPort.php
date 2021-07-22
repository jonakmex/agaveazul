<?php
namespace App\Boundary\Input;

use App\Boundary\Input\InputPort;

class CreateUnitInputPort extends InputPort {
    public $description;

    public function validate()
    {
        $errors = array();
        if($this->description == null || strlen($this->description) < 3)
            array_push($errors,["description","MSG_ERR_001",["value",$this->description]]);

        return $errors;
    }
}