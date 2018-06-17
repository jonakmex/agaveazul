<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cuentamovimiento extends Model
{
  protected $table = 'cuentamovimiento';
  public function cuenta(){
    return $this->hasMany('App\Cuenta');
  }
}
