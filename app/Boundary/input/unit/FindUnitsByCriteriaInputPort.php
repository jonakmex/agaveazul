<?php
namespace App\Boundary\Input\Unit;
use App\Boundary\InputPort;

class FindUnitsByCriteriaInputPort extends InputPort {
    public $description;
    public function validate()
    {
        $errors = array();
        return $errors;
    }
}