<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cuota extends Model
{
  public function recibosHeader(){
    return $this->hasMany('App\Reciboheader');
  }

  public function recibos(){
    return $this->hasManyThrough('App\Recibos', 'App\Reciboheader');
  }

  public function viviendas(){
    return $this->hasMany('App\CuotaVivienda');
  }
}
