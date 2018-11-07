<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cuentamovimiento extends Model
{
  protected $table = 'cuentamovimiento';

  public function __construct(){
    $this->saldo = 0;
  }

  public function cuenta(){
    return $this->hasMany('App\Cuenta');
  }
}
