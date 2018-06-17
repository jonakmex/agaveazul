<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reciboheader extends Model
{
  protected $table = 'reciboheader';
  public $timestamps = false;

  public function cuota()
  {
      return $this->belongsTo('App\Cuota');
  }
  public function recibos()
  {
      return $this->hasMany('App\Recibos');
  }
}
