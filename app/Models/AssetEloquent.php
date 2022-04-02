<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetEloquent extends Model
{
    use HasFactory;
    protected $table = "asset";

    public function unit(){
        return $this->belongsTo('App\Models\UnitEloquent');
    }
}
