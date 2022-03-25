<?php

namespace App\Domains\Condo\UseCase;


use App\Domains\Shared\UseCase\UseCase;
use App\Domains\Shared\Boundary\Request;
use App\Domains\Shared\Boundary\Response;
use App\Domains\Condo\Repository\UnitRepository;
use App\Domains\Condo\Boundary\Output\FindUnitByIdResponse;
use App\Domains\Condo\Boundary\DataStructure\UnitDS;
use App\Domains\Condo\Entities\Unit;

class FindUnitByIdUseCase implements UseCase{

    private UnitRepository $unitRepository;

    public function __construct(UnitRepository $unitRepository){
        $this->unitRepository = $unitRepository;
    }

    public function execute(Request $request,$callback){
        $errors = $request->validate();
        if(!empty($errors))
            return $callback(Response::makeFailResponse($errors));
            
        
        $unit = $this->unitRepository->findById($request->id);
        

        if($callback != null)
            return $callback($this->makeResponse($unit));
    }

    private function makeResponse(Unit $unit){
        $response = new FindUnitByIdResponse;
        $unitDS = new UnitDS;
        $unitDS->id = $unit->getId();
        $unitDS->description = $unit->getDescription();
        $response->unitDS = $unitDS;

        return $response;
    }
}