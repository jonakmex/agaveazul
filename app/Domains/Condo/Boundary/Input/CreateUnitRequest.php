<?php
namespace App\Domains\Condo\Boundary\Input;

use App\Domains\Shared\Boundary\Request;

class CreateUnitRequest extends Request
{
    public $description;

    public function validate(){
        $errors = [];
        if(strlen($this->description) < 1)
            array_push($errors,["description"=>"MSG_ERR_TOO_SHORT"]);

        if(strlen($this->description) > 50)
            array_push($errors,["description"=>"MSG_ERR_TOO_LARGE"]);

        return $errors;
    }
}