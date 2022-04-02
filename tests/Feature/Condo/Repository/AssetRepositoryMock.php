<?php

namespace Tests\Feature\Condo\Repository;

use App\Domains\Condo\Repository\AssetRepository;
use App\Domains\Condo\Entities\Asset;

class AssetRepositoryMock implements AssetRepository{
  public function save(Asset $asset){
    echo "Saving mock";
    $random_base64 = base64_encode(random_bytes(18));
    $asset->setId(serialize($random_base64));
    return $asset;
  }

  public function findById($id){
    $asset = new Asset;
    $asset->setId($id);
    $asset->setUnitId(1);
    $asset->setDescription("TAG 0000-2332-222");
    $asset->setType("TAG");
    return $asset;
  }

  public function update(Asset $asset){
    echo "Updating ";
    return $asset;
  }

  public function findAssetsByCriteria($description, $type, $unitId){
    $all = [];

    if($description === "noexiste" || $type === "NO EXISTE" || $unitId < 0) 
      return $all;
    
    for ($i = 0; $i < 5; $i++) { 
      $asset = new Asset;
      $asset->setId($i);
      $asset->setUnitId($unitId);
      $asset->setType("AUTOMOVIL");
      $asset->setDescription("test");
      array_push($all, $asset);
    }

    return $all;
  }

  public function delete($id){
    $asset = new Asset;
    $asset->setId($id);
    $asset->setUnitId(1);
    $asset->setType("AUTOMOVIL");
    $asset->setDescription("Carro rojo mustang 68");

    return $asset;
  }
}