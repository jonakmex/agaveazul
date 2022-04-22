<?php
namespace App\Domains\Condo\Repository;
use App\Domains\Condo\Entities\Unit;
use App\Domains\Shared\Entities\Order;
use App\Domains\Shared\Entities\Pagination;

interface UnitRepository {
    public function save(Unit $unit);
    public function update(Unit $unit);
    public function findById($id);
    public function findUnitsByCriteria($description, Pagination $pagination = null, Order $order = null);
    public function delete($id);
}
