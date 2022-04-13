<?php
namespace App\Domains\Condo\Repository;
use App\Domains\Condo\Entities\Unit;

interface UnitRepository {
    public function save(Unit $unit);
    public function update(Unit $unit);
    public function findById($id);
    public function findUnitsByCriteria($description);
    public function delete($id);
}