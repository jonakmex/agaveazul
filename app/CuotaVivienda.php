<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CuotaVivienda extends Model
{
    public $timestamps = false;

    public function vivienda(){
      return $this->belongsTo('App\Vivienda');
    }
}
