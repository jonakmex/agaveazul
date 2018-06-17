<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vivienda extends Model
{
    protected $table = "vivienda";

    public function residentes(){
      return $this->hasMany('App\Residente');
    }

    public function cuotas(){
      return $this->hasMany('App\CuotaVivienda');
    }
}
