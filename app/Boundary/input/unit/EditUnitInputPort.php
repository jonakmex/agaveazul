<?php
namespace App\Boundary\Input\Unit;
use App\Boundary\InputPort;
use Illuminate\Support\Facades\Log;

class EditUnitInputPort extends InputPort {
    public $id;
    public $description;

    public function validate()
    {
        
        $errors = array();
        if($this->id == null || !is_numeric($this->id))
            array_push($errors,["id","MSG_ERR_001",["value",$this->id]]);

        if($this->description == null || strlen($this->description) < 3)
            array_push($errors,["description","MSG_ERR_001",["value",$this->description]]);

        Log::info($errors);
        return $errors;
    }
}