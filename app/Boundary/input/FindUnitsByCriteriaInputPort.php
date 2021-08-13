<?php
namespace App\Boundary\Input;
use App\Boundary\InputPort;

class FindUnitsByCriteriaInputPort extends InputPort {
    public $description;
    public function validate()
    {
        $errors = array();
        return $errors;
    }
}