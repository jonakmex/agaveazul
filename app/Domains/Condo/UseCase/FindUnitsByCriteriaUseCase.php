<?php

namespace App\Domains\Condo\UseCase;


use App\Domains\Shared\UseCase\UseCase;
use App\Domains\Shared\Boundary\Request;
use App\Domains\Shared\Boundary\Response;
use App\Domains\Condo\Repository\UnitRepository;
use App\Domains\Condo\Boundary\Output\FindUnitsByCriteriaResponse;
use App\Domains\Condo\Boundary\DataStructure\UnitDS;

class FindUnitsByCriteriaUseCase implements UseCase{

    private UnitRepository $unitRepository;

    public function __construct(UnitRepository $unitRepository){
        $this->unitRepository = $unitRepository;
    }

    public function execute(Request $request,$callback){
        $errors = $request->validate();
        if(!empty($errors))
            return $callback(Response::makeFailResponse($errors));
        
        $paginate = null;
        if($request->paginateDS != null)
            $paginate = $this->makePaginate($request->paginate);

        $order = null;
        if($request->orderDS != null)
            $order = $this->makeOrder($request->order);

        //si es espacio en blanco retornamos todos de lo contrario aplicamos un filtro
        $units = $this->unitRepository->findUnitsByCriteria($request->description,$paginate,$order);


        if($callback != null)
            return $callback($this->makeResponse($units));
    }

    /**
     * @param $units Unit[]
     */
    private function makeResponse($units){
        $response = new FindUnitsByCriteriaResponse;
        $response->unitsDS = [];

        foreach($units as $unit) {
            $unitDS = new UnitDS;
            $unitDS->id = $unit->getId();
            $unitDS->description = $unit->getDescription();
            array_push($response->unitsDS,$unitDS);
        }

        return $response;
    }

    private function makePaginate($paginateDS){
        $paginate = new Paginate;
        
        return $paginate;

    }
}