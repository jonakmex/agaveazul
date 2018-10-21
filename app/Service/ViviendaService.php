<?php
namespace App\Service;

use App\Vivienda;
use App\BusinessException;

class ViviendaService
{
    public static function save(Vivienda $vivienda)
    {
      if($vivienda->save()){
        return $vivienda;
      }
      else{
        throw new BusinessException();
      }
    }
}
