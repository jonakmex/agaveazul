<?php

namespace App;
use App\Service\NumberToLetterConverter;

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
      return '/storage/'.'rec_'.$this->id;
  }

  public function storage(){
    return 'rec_'.$this->id;
  }

  public function folio(){
    $cuota = $this->reciboHeader->cuota;
    $month = date('m',strtotime($this->reciboHeader->fecVence));
    $year =  date('y',strtotime($this->reciboHeader->fecVence));
    return $this->vivienda->clave.$cuota->clave.$month.$year;
  }

  public function importeLetra(){
    $letter = new NumberToLetterConverter();
    return $letter->to_word($this->importe+$this->ajuste,'MXN');
  }
}
