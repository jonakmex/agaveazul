<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $table = 'profile';
    public $timestamps = true;

    public function tokens(){
      return $this->hasMany('App\RegisterToken');
    }
}
