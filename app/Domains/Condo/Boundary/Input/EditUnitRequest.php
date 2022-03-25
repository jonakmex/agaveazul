<?php
namespace App\Domains\Condo\Boundary\Input;

use App\Domains\Shared\Boundary\Request;


class EditUnitRequest extends Request
{
    public $description;
    public $id;

    public function validate(){
        $errors = [];
        if(strlen($this->description) < 1)
            array_push($errors,["description"=>"MSG_ERR_TOO_SHORT"]);

        if(strlen($this->description) > 10)
            array_push($errors,["description"=>"MSG_ERR_TOO_LARGE"]);

        if($this->id < 0)
            array_push($errors,["id"=>"MSG_ERR_NOT_NEGATIVE"]);

        return $errors;
    }
}