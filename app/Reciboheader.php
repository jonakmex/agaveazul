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

  public function estado(){
    //Calculamos porcentaje de avance de cobro
    $total = $this->recibos()->sum('importe');
    $cobrado = $this->saldo;
    return ($cobrado * 100) / $total;
  }
}
