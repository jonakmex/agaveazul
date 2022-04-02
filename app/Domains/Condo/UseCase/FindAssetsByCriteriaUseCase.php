<?php

namespace App\Domains\Condo\UseCase;


use App\Domains\Shared\UseCase\UseCase;
use App\Domains\Shared\Boundary\Request;
use App\Domains\Shared\Boundary\Response;
use App\Domains\Condo\Repository\AssetRepository;
use App\Domains\Condo\Boundary\Output\FindAssetsByCriteriaResponse;
use App\Domains\Condo\Boundary\DataStructure\AssetDS;

class FindAssetsByCriteriaUseCase implements UseCase{

    private AssetRepository $assetRepository;

    public function __construct(AssetRepository $assetRepository){
        $this->assetRepository = $assetRepository;
    }

    public function execute(Request $request,$callback){
        $errors = $request->validate();
        if(!empty($errors))
            return $callback(Response::makeFailResponse($errors));

       $assets = $this->assetRepository->findAssetsByCriteria($request->description,$request->type,$request->unitId);

        if($callback != null)
            return $callback($this->makeResponse($assets));
    }

    private function makeResponse($assets){
        $response = new FindAssetsByCriteriaResponse;
        $response->assetsDS = [];

        foreach($assets as $asset) {
            $assetDS = new AssetDS;
            $assetDS->id = $asset->getId();
            $assetDS->unitId = $asset->getUnitId();
            $assetDS->type = $asset->getType();
            $assetDS->description = $asset->getDescription();
            array_push($response->assetsDS, $assetDS);
        }

        return $response;
    }
}