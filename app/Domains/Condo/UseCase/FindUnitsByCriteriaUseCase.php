<?php

namespace App\Domains\Condo\UseCase;


use App\Domains\Shared\UseCase\UseCase;
use App\Domains\Shared\Boundary\Request;
use App\Domains\Shared\Boundary\Response;
use App\Domains\Condo\Repository\UnitRepository;
use App\Domains\Condo\Boundary\Output\FindUnitsByCriteriaResponse;
use App\Domains\Condo\Boundary\DataStructure\UnitDS;
use App\Domains\Shared\Entities\Pagination;
use App\Domains\Shared\Entities\Order;

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
        if($request->pagination != null)
            $paginate = $this->makePaginate($request->pagination);

        $order = null;
        if($request->order != null)
            $order = $this->makeOrder($request->order);

        //si es espacio en blanco retornamos todos de lo contrario aplicamos un filtro
        $units = $this->unitRepository->findUnitsByCriteria($request->description, $paginate, $order);
       


        if($callback != null)
            return $callback($this->makeResponse($units, $paginate));
    }

    /**
     * @param $units Unit[]
     */
    private function makeResponse($units, Pagination $paginate = null){
        $response = new FindUnitsByCriteriaResponse;
        $response->unitsDS = [];

        foreach($units as $unit) {
            $unitDS = new UnitDS;
            $unitDS->id = $unit->getId();
            $unitDS->description = $unit->getDescription();
            array_push($response->unitsDS,$unitDS);
        }
        if($paginate != null){
            $totalRecords = $this->unitRepository->getPages();
            $numRecordsPerPage = $paginate->getNumRecordsPerPage();
            $response->numberOfPages = ceil($totalRecords/$numRecordsPerPage);
        }

        return $response;
    }

    private function makePaginate($paginateDS){
        $paginate = new Pagination;
        $paginate->setNumRecordsPerPage($paginateDS->numRecordsPerPage);
        $paginate->setPageNumber($paginateDS->pageNumber);
        
        return $paginate;

    }
    private function makeOrder($orderDS){
        $order = new Order;
        $order->setOrderBy($orderDS->orderBy);
        $order->setOrderDirection($orderDS->orderDirection);

        return $order;

    }
}