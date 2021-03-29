<?php

namespace App\Interactors\Ports\Input\Unit;

use App\Interactors\Ports\Input;
use App\Interactors\Validators\Validator;

class CreateUnitInputPort extends Input 
{
    public $description;
    public $reference;

    public function validate(){
        $errors = array();
        $description_errors = Validator::mandatoryInBetween($this->description,1,20);
        $reference_errors = Validator::mandatoryInBetween($this->reference,1,20);

        if(!empty($description_errors))
            $errors['description'] = $description_errors;

        if(!empty($reference_errors))
            $errors['reference'] = $reference_errors;

        return $errors;
    }
}