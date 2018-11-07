<?php
namespace App\Exception;

class BusinessException
{
  protected $errors;

  public function __construct($errors){
    $this->errors = $errors;
  }
}
