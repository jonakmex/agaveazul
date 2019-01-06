<?php

namespace App;
use Storage;

use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    protected $table = 'documento';

    function __construct(){
      $this->estado = 1;
    }

    public function dir()
    {
        return 'doc_'.$this->id;
    }

    public function url(){
       return Storage::url($this->dir().'/'.$this->archivo);
    }
}
