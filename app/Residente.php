<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Residente extends Model
{
  public function __construct(){
    $this->estado = 1;
  }
  public function vivienda()
  {
      return $this->belongsTo('App\Vivienda');
  }

  public function strTipo(){
    switch($this->tipo){
      case 1:
        return "Propietario";
      case 2:
        return "Inquilino";
      case 3:
        return "Representante";
    }
  }

  public function token(){
    return $this->hasOne('App\registerToken');
  }
}
