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

class FindUnitsByCriteriaUseCase implements UseCase
{
    private UnitRepository $unitRepository;

    public function __construct(UnitRepository $unitRepository)
    {
        $this->unitRepository = $unitRepository;
    }

    public function execute(Request $request, $callback)
    {
        $errors = $request->validate();
        if (!empty($errors))
            return $callback(Response::makeFailResponse($errors));

        $pagination = null;
        if($request->pagination !== null)
            $pagination = $this->makePagination($request->pagination);

        $order = null;
        if($request->order !== null)
            $order = $this->makeOrder($request->order);

        $units = $this->unitRepository->findByCriteria($request->description, $pagination, $order);

        if ($callback != null)
            return $callback($this->makeResponse($units, $pagination));
    }

    private function makeResponse($units, Pagination $pagination = null)
    {
        $response = new FindUnitsByCriteriaResponse;

        $response->unitsDS = array_map(function($unit){
            $unitDS = new UnitDS();
            $unitDS->id = $unit->getId();
            $unitDS->description = $unit->getDescription();
            return $unitDS;
        },$units);

        if ($pagination !== null) {
            $response->totalUnits = $this->unitRepository->count();
            $response->totalPages = (int) ceil($response->totalUnits / $pagination->getPerPage());
            $response->nextPage = ($pagination->getPageNumber() + 1 <= $response->totalPages) ? $pagination->getPageNumber() + 1 : null;
            $response->prevPage = ($pagination->getPageNumber() == 0) ? null : $pagination->getPageNumber() - 1;
        }

        return $response;
    }

    private function makePagination($paginationDS): Pagination
    {
        return new Pagination($paginationDS->perPage, $paginationDS->pageNumber);
    }

    private function makeOrder($orderDS): Order
    {
        return new Order($orderDS->orderBy, $orderDS->orderDirection);
    }
}