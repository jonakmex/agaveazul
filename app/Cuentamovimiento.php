<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cuentamovimiento extends Model
{
  protected $table = 'cuentamovimiento';

  public function __construct(){
    $this->saldo = 0;
  }

  public function cuenta(){
    return $this->belongsTo('App\Cuenta');
  }

  public function recibo(){
    return $this->belongsTo('App\Recibos','recibos_id','id');
  }

  public function publicDescription(){
    $descripcion = "";
    if(strpos($this->descripcion,">")!== false){
      $items = explode('>',$this->descripcion);
      $descripcion = $items[0]." ".$items[2];
    }
    else{
      $descripcion = $this->descripcion;
    }

    return $descripcion;
  }
}
