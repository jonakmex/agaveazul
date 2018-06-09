<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Residente extends Model
{
  public function vivienda()
  {
      return $this->belongsTo('App\Vivienda');
  }
}
