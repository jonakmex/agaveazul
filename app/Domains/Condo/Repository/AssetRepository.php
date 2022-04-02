<?php
namespace App\Domains\Condo\Repository;
use App\Domains\Condo\Entities\Asset;

interface AssetRepository {
    public function save(Asset $asset);
    public function findById($id);
    public function update(Asset $asset);
    public function findAssetsByCriteria($description, $type, $unitId);
    public function delete($id);
}
