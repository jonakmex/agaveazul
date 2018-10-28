<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recibos extends Model
{
  public function reciboheader()
  {
    return $this->belongsTo('App\Reciboheader');
  }

  public function vivienda()
  {
    return $this->belongsTo('App\Vivienda');
  }

  public function dir()
  {
      return '/storage/'.'rec_'.$this->id.'/';
  }

  public function storage(){
    return 'rec_'.$this->id.'/';
  }

}
