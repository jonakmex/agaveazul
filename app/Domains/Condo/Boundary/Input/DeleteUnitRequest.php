<?php
namespace App\Domains\Condo\Boundary\Input;

use App\Domains\Shared\Boundary\Request;

class DeleteUnitRequest extends Request
{
    public $id;

    public function validate(){
        $errors = [];

        if($this->id < 0)
            array_push($errors,["id"=>"MSG_ERR_MUST_BE_POSITIVE"]);

        return $errors;
    }
}