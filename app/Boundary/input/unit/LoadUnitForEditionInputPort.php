<?php
namespace App\Boundary\Input\Unit;
use App\Boundary\InputPort;

class LoadUnitForEditionInputPort extends InputPort {
    public $id;

    public function validate()
    {
        $errors = array();
        if($this->id == null || !is_numeric($this->id))
            array_push($errors,["id","MSG_ERR_001",["value",$this->id]]);
        return $errors;
    }
}