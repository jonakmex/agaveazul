<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactEloquent extends Model
{
    protected $table = "contacts";
    use HasFactory;

    public function UnitEloquent()
    {
        return $this->belongsTo(UnitEloquent::class);
    }
}
