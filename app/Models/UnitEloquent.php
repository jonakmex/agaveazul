<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitEloquent extends Model
{
    use HasFactory;
    protected $table = "unit";

    public function assets(){
        return $this->hasMany(AssetEloquent::class);
    }

    public function contacts()
    {
        return $this->hasMany(ContactEloquent::class);
    }
}
