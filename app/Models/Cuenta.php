<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cuenta extends Model
{
  public function movimientos(){
    return $this->hasMany('App\Cuentamovimiento')->orderBy('id','desc');
  }
}
