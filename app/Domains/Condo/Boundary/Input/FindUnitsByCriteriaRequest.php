<?php
namespace App\Domains\Condo\Boundary\Input;

use App\Domains\Shared\Boundary\Request;

class FindUnitsByCriteriaRequest extends Request {
  public $description;

  public function validate(){
    $errors = [];
    
    if(strlen($this->description) > 100)
        array_push($errors,["description"=>"MSG_ERR_TOO_LARGE"]);

    return $errors;
  }
}