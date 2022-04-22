<?php
namespace App\Domains\Condo\Repository;
use App\Domains\Condo\Entities\Unit;
use App\Models\UnitEloquent;
use App\Domains\Shared\Entities\Order;
use App\Domains\Shared\Entities\Pagination;

class UnitEloquentRepository implements UnitRepository {

    public function save(Unit $unit){
        $unitEloquent = new UnitEloquent();
        $unitEloquent->description = $unit->getDescription();
        $unitEloquent->save();
        $unit->setId($unitEloquent->id);
    }

    public function findById($id){
        $unitEloquent = UnitEloquent::findOrFail($id);
        $unit = new Unit();
        $unit->setId($unitEloquent->id);
        $unit->setDescription($unitEloquent->description);
        return $unit; 
    }

    public function update(Unit $unit){
        $unitEloquent = UnitEloquent::findOrFail($unit->getId());
        $unitEloquent->description = $unit->getDescription();
        $unitEloquent->save();
        return $unit;
    }

    public function findUnitsByCriteria($description,Pagination $pagination = null, Order $order = null){
        $query = UnitEloquent::where('description','like','%'.$description.'%');
        if($pagination != null)
            $query->paginate($pagination->getNumRecordsPerPage, ['*'], 'page',$pagination->getPageNumber);
        
        if($order != null)
            $query->orderBy($order->orderBy,$order->orderDirection);

        $unitsEloquent = $query->get();
        $units = [];

        foreach($unitsEloquent as $unitEloquent) {
            $unit = new Unit();
            $unit->setId($unitEloquent->id);
            $unit->setDescription($unitEloquent->description);
            array_push($units, $unit);
        }

        return $units;
    }


    public function delete($id){
        $unitEloquent = UnitEloquent::findOrFail($id);
        $unit = new Unit;
        $unit->setId($unitEloquent->id);
        $unit->setDescription($unitEloquent->description);
        $unitEloquent->delete();

        return $unit;
    }
}
