<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitEloquent extends Model
{
    protected $table = "unit";
    use HasFactory;

    public function assets(){
        return $this->hasMany('App\Models\AssetEloquent');
    }

    public function ContactEloquent()
    {
        return $this->hasMany(ContactEloquent::class);
    }
}
