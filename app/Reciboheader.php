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
    $total = count($this->cuota->viviendas) * $this->cuota->importe;
    $total = $total == 0 ? 1 : $total;
    $cobrado = $this->recibos()->where('estado',2)->sum('importe');
    return round(($cobrado * 100) / $total);
  }

  public function total(){
    return round(count($this->cuota->viviendas) * $this->cuota->importe);
  }
}
