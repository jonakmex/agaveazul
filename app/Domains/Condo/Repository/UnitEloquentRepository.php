<?php
namespace App\Domains\Condo\Repository;
use App\Domains\Condo\Entities\Unit;
use App\Models\UnitEloquent;

class UnitEloquentRepository implements UnitRepository {

    public function save(Unit $unit){
        $unitEloquent = new UnitEloquent();
        $unitEloquent->description = $unit->getDescription();
        $unitEloquent->save();
        $unit->setId($unitEloquent->id);
    }
}
