<?php
namespace App\Service;

use App\Documento;
use App\BusinessException;
use \Datetime;

class DocumentoService
{
    public static function save(Documento $documento)
    {
      if($documento->save()){
        return $documento;
      }
      else{
        throw new BusinessException();
      }
    }

}
