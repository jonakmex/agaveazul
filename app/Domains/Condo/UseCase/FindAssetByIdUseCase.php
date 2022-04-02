<?php

namespace App\Domains\Condo\UseCase;

use App\Domains\Condo\Boundary\DataStructure\AssetDS;
use App\Domains\Condo\Boundary\Output\FindAssetByIdResponse;
use App\Domains\Condo\Entities\Asset;
use App\Domains\Condo\Repository\AssetRepository;
use App\Domains\Shared\Boundary\Request;
use App\Domains\Shared\Boundary\Response;
use App\Domains\Shared\UseCase\UseCase;

class FindAssetByIdUseCase implements UseCase{

    private AssetRepository $assetRepository;

    public function __construct(AssetRepository $assetRepository){
        $this->assetRepository = $assetRepository;
    }

    public function execute(Request $request, $callback){
        $errors = $request->validate();
        if(!empty($errors))
            return $callback(Response::makeFailResponse($errors));
            
        $asset = $this->assetRepository->findById($request->id);
        
        if($callback != null)
            return $callback($this->makeResponse($asset));
    }
    
    private function makeResponse(Asset $asset){
        $response = new FindAssetByIdResponse;
        $assetDS = new AssetDS;
        $assetDS->id = $asset->getId();
        $assetDS->unitId = $asset->getUnitId();
        $assetDS->type = $asset->getType();
        $assetDS->description = $asset->getDescription();
        $response->assetDS = $assetDS;

        return $response;
    }
}