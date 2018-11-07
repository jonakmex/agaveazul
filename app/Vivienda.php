<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Service\ViviendaService;
use Log;

class Vivienda extends Model
{
    protected $table = "vivienda";

    function __construct(){
      $this->estado = 1;
    }

    public function residentes(){
      return $this->hasMany('App\Residente');
    }

    public function contactoPrincipal(){
      $principal = $this->residentes()->where('principal',1)->first();
      if($principal === null){
        $principal = $this->residentes()->first();
      }
      Log::debug($principal->nombre);
      return $principal;
    }

    public function cuotas(){
      return $this->hasMany('App\CuotaVivienda');
    }

    public function saldo(){
      return ViviendaService::calcularSaldo($this);
    }

    public function estado(){
      return ViviendaService::calcularEstatus($this);
    }
}
