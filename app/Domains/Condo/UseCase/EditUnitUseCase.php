<?php

namespace App\Domains\Condo\UseCase;


use App\Domains\Shared\UseCase\UseCase;
use App\Domains\Shared\Boundary\Request;
use App\Domains\Shared\Boundary\Response;
use App\Domains\Condo\Repository\UnitRepository;
use App\Domains\Condo\Boundary\Output\EditUnitResponse;
use App\Domains\Condo\Boundary\DataStructure\UnitDS;
use App\Domains\Condo\Entities\Unit;

class EditUnitUseCase implements UseCase{

    private UnitRepository $unitRepository;

    public function __construct(UnitRepository $unitRepository){
        $this->unitRepository = $unitRepository;
    }

    public function execute(Request $request,$callback){
        $errors = $request->validate();
        if(!empty($errors))
            return $callback(Response::makeFailResponse($errors));
        
        $unit = new Unit();
        $unit->setId($request->id);
        $unit->setDescription($request->description);
     
        $this->unitRepository->update($unit);

        if($callback != null)
            return $callback($this->makeResponse($unit));
    }


    private function makeResponse(Unit $unit){
        $response = new EditUnitResponse;
        $unitDS = new UnitDS;
        $unitDS->id = $unit->getId();
        $unitDS->description = $unit->getDescription();
        $response->unitDS = $unitDS;

        return $response;
    }
}