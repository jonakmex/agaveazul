<?php
namespace App\Domains\Condo\Repository;
use App\Domains\Condo\Entities\Asset;
use App\Models\AssetEloquent;

class AssetEloquentRepository implements AssetRepository {

    public function save(Asset $asset){
        $assetEloquent = new AssetEloquent();
        $assetEloquent->description = $asset->getDescription();
        $assetEloquent->unit_id = $asset->getUnitId();
        $assetEloquent->type = $asset->getType();
        $assetEloquent->save();
        $asset->setId($assetEloquent->id);
    }

    public function findById($id){
        $assetEloquent = AssetEloquent::findOrFail($id);
        $asset = new Asset();
        $asset->setId($assetEloquent->id);
        $asset->setUnitId($assetEloquent->unit_id);
        $asset->setDescription($assetEloquent->description);
        $asset->setType($assetEloquent->type);
        return $asset; 
    }

    public function update(Asset $asset){
        $assetEloquent = AssetEloquent::findOrFail($asset->getId());

        if($asset->getDescription() != null) 
            $assetEloquent->description = $asset->getDescription();
        else 
            $asset->setDescription($assetEloquent->description);
        
        if($asset->getType() != null)
            $assetEloquent->type = $asset->getType();
        else
            $asset->setType($assetEloquent->type);
            
        $assetEloquent->save();
        $asset->setUnitId($assetEloquent->unit_id);
        return $asset;
    }

    public function findAssetsByCriteria($description, $type, $unitId){
        $assetsEloquent = AssetEloquent::where('description', 'like', '%'.$description.'%', 'and')
                                        ->where('type', 'like','%'.$type.'%', 'and')
                                        ->where('unit_id', '=', $unitId)
                                        ->get();
        
        $assets = [];

        foreach($assetsEloquent as $assetEloquent) {
            $asset = new Asset();
            $asset->setId($assetEloquent->id);
            $asset->setUnitId($assetEloquent->unit_id);
            $asset->setDescription($assetEloquent->description);
            $asset->setType($assetEloquent->type);
            array_push($assets, $asset);
        }

        return $assets;
    }

    public function delete($id){
        $assetEloquent = AssetEloquent::findOrFail($id);
        $asset = new Asset;
        $asset->setId($assetEloquent->id);
        $asset->setUnitId($assetEloquent->unit_id);
        $asset->setDescription($assetEloquent->description);
        $asset->setType($assetEloquent->type);
        $assetEloquent->delete();

        return $asset;
    }
}
