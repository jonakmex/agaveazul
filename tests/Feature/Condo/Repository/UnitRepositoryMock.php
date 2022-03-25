<?php

namespace Tests\Feature\Condo\Repository;
use App\Domains\Condo\Repository\UnitRepository;
use App\Domains\Condo\Entities\Unit;

class UnitRepositoryMock implements UnitRepository{
    public function save(Unit $unit){
        echo "Saving mock";
        $random_base64 = base64_encode(random_bytes(18));
        $unit->setId(serialize($random_base64));
        return $unit;
    }

    public function findById($id){
        echo "searching unit in repo";
        $unit = new Unit; 
        $unit->setId($id);
        $unit->setDescription("Testing");

        return $unit;
    }

    public function update(Unit $unit){
        echo "updating unit";

        $unitUpdated = new Unit; 
        $unitUpdated->setId($unit->getId());
        $unitUpdated->setDescription($unit->getDescription());

        return $unit;
    }
}