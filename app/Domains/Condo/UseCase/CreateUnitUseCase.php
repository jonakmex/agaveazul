<?php

namespace App\Domains\Condo\UseCase;


use App\Domains\Shared\UseCase\UseCase;
use App\Domains\Shared\Boundary\Request;
use App\Domains\Shared\Boundary\Response;
use App\Domains\Condo\Repository\UnitRepository;
use App\Domains\Condo\Boundary\Output\CreateUnitResponse;
use App\Domains\Condo\Boundary\DataStructure\UnitDS;
use App\Domains\Condo\Entities\Unit;

class CreateUnitUseCase implements UseCase{

    private UnitRepository $unitRepository;

    public function __construct(UnitRepository $unitRepository){
        $this->unitRepository = $unitRepository;
    }

    public function execute(Request $request,$callback){
        $errors = $request->validate();
        if(!empty($errors))
            return $callback(Response::makeFailResponse($errors));
            
        $unit = $this->makeUnit($request);
        $this->unitRepository->save($unit);

        if($callback != null)
            return $callback($this->makeResponse($unit));
    }

    private function makeUnit(Request $request){
        $unit = new Unit;
        $unit->setDescription($request->description);
        return $unit;
    }

    private function makeResponse(Unit $unit){
        $response = new CreateUnitResponse;
        $unitDS = new UnitDS;
        $unitDS->id = $unit->getId();
        $unitDS->description = $unit->getDescription();
        $response->unitDS = $unitDS;

        return $response;
    }
}