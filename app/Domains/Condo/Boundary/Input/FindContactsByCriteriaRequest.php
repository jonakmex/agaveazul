<?php
namespace App\Domains\Condo\Boundary\Input;

use App\Domains\Shared\Boundary\Request;

class FindContactsByCriteriaRequest extends Request
{
    public $name;
    public $unit_id;
    public $type;
    public $lastName;

    public function validate(){
        $errors = [];
        
        if(strlen($this->name) > 20)
            array_push($errors,["name"=>"MSG_ERR_TOO_LARGE"]);
        
        if(strlen($this->lastName) > 20)
            array_push($errors,["name"=>"MSG_ERR_TOO_LARGE"]);
        
        
        return $errors;
      }
}