<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email','phone', 'password','dob','height','gender','coach_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function getAge(){
       //return  $this->dob->diffInYears(Carbon::now());
        return 35;
    }

    public function measures(){
        return $this->hasMany('App\Measure')->orderBy('id','desc')->limit(10);
    }

    public function coach(){
        return $this->belongsTo('App\Coach');
    }
}
