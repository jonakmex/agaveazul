<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegisterToken extends Model
{
    protected $table = 'registerTokens';

    public function profile(){
      return $this->belongsTo('App\Profile');
    }

    public function residente(){
      return $this->belongsTo('App\Residente');
    }
}
