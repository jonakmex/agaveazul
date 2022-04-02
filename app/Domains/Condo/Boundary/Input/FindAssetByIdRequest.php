<?php

namespace App\Domains\Condo\Boundary\Input;

use App\Domains\Shared\Boundary\Request;

class FindAssetByIdRequest extends Request{
  public $id;

  public function validate(){
    $errors = [];

    if($this->id < 0)
      array_push($errors, ["id"=>"ERR_MSG_MUST_BE_POSITIVE"]);

    return $errors;
  }
}