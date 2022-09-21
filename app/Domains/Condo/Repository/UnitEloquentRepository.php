<?php

namespace App\Domains\Condo\Repository;

use App\Domains\Condo\Entities\Unit;
use App\Models\UnitEloquent;
use App\Domains\Shared\Entities\Order;
use App\Domains\Shared\Entities\Pagination;

class UnitEloquentRepository implements UnitRepository
{

    public function save(Unit $unit)
    {
        $unitEloquent = new UnitEloquent();
        $unitEloquent->description = $unit->getDescription();
        $unitEloquent->save();
        $unit->setId($unitEloquent->id);
    }

    public function findById($id): Unit
    {
        $unitEloquent = UnitEloquent::findOrFail($id);
        $unit = new Unit();
        $unit->setId($unitEloquent->id);
        $unit->setDescription($unitEloquent->description);
        return $unit;
    }

    public function update(Unit $unit)
    {
        $unitEloquent = UnitEloquent::findOrFail($unit->getId());
        $unitEloquent->description = $unit->getDescription();
        $unitEloquent->save();
    }

    public function findByCriteria($description, ?Pagination $pagination = null, ?Order $order = null)
    {
        $query = UnitEloquent::where('description', 'like', '%' . $description . '%');

        if ($order != null)
            $query->orderBy($order->getOrderBy(), $order->getOrderDirection());

        if ($pagination != null)
            $query->paginate($pagination->getPerPage(), ['*'], 'page', $pagination->getPageNumber());

        $unitsEloquent = $query->get()->toArray();

        return array_map(function ($unitEloquent) {
            $unit = new Unit();
            $unit->setId($unitEloquent['id']);
            $unit->setDescription($unitEloquent['description']);
            return $unit;
        }, $unitsEloquent);
    }


    public function delete($id): Unit
    {
        $unitEloquent = UnitEloquent::findOrFail($id);
        $unit = new Unit();
        $unit->setId($unitEloquent->id);
        $unit->setDescription($unitEloquent->description);
        $unitEloquent->delete();

        return $unit;
    }

    public function count(): int
    {
        return UnitEloquent::count();
    }
}
