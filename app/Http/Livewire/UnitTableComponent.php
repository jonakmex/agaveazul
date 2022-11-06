<?php

namespace App\Http\Livewire;

use App\Domains\Shared\Boundary\DS\OrderDS;
use App\Domains\Shared\Boundary\DS\PaginationDS;
use App\Domains\Shared\Boundary\RequestFactory;
use App\Domains\Shared\UseCase\UseCaseFactory;
use App\Http\Controllers\ViewModel\UnitVm;
use Livewire\Component;
use Livewire\WithPagination;

class UnitTableComponent extends Component
{
    use WithPagination;

    public $config;
    public $data;
    public $heads;

    public $description;
    public $perPage;
    public $pageNumber;
    public $orderBy;
    public $orderDirection;
    public $totalPages;
    public $totalUnits;
    public $nextPage;
    public $prevPage;

    protected $queryString = ['description' => ['except' => '']];
    protected $listeners = ['deleteUnit', 'refresh' => 'render'];

    private $requestFactory;
    private $useCaseFactory;
    private $findUnitsByCriteriaUseCase;
    private $deleteUnitUseCase;
    private $paginationDS;
    private $orderDS;


    public function __construct()
    {
        parent::__construct();
        $this->requestFactory = app(RequestFactory::class);
        $this->useCaseFactory = app(UseCaseFactory::class);
        $this->findUnitsByCriteriaUseCase = $this->useCaseFactory->make(FIND_UNITS_BY_CRITERIA_USE_CASE);
        $this->deleteUnitUseCase = $this->useCaseFactory->make(DELETE_UNIT_USE_CASE);

        $this->heads = [
            'ID',
            'Description',
            ['label' => 'Actions', 'no-export' => true, 'width' => '20']
        ];

        $this->config = [
            'ordering' => false,
            'paging' => false,
            'lengthChange' => false,
            'info' => false,
            'searching' => false,
        ];

        $this->paginationDS = new PaginationDS();
        $this->orderDS = new OrderDS();
        $this->perPage = '10';
        $this->pageNumber = '1';
        $this->orderBy = 'id';
        $this->orderDirection = 'asc';
    }

    public function render()
    {
        $this->paginationDS->perPage = $this->perPage;
        $this->paginationDS->pageNumber = $this->pageNumber;
        $this->orderDS->orderBy = $this->orderBy;
        $this->orderDS->orderDirection = $this->orderDirection;
        $findUnitsByCriteriaRequest = $this->requestFactory->make(FIND_UNITS_BY_CRITERIA_REQUEST,
            ["description" => $this->description, "pagination" => $this->paginationDS, "order" => $this->orderDS]
        );

        $this->findUnitsByCriteriaUseCase->execute($findUnitsByCriteriaRequest, function ($response) {
            if (!$response->errors) {
                $this->data = $this->makeUnitVm($response->unitsDS);
                $this->totalUnits = $response->totalUnits;
                $this->totalPages = $response->totalPages;
                $this->nextPage = $response->nextPage;
                $this->prevPage = $response->prevPage;
            }
        });


        return view('livewire.unit-table-component');
    }

    private function makeUnitVm($unitsDS)
    {
        return array_map(function ($unitDS) {
            $unitVm = new UnitVm();
            $unitVm->id = $unitDS->id;
            $unitVm->description = $unitDS->description;
            $actionShow = '<a href="' . route('unit.show', $unitDS->id) . '" class="btn btn-xs text-teal mx-1" title="Show"><i class="fa fa-lg fa-fw fa-eye"></i></a>';
            $actionEdit = '<a href="' . route('unit.edit', $unitDS->id) . '" class="btn btn-xs text-primary mx-1" title="Edit"><i class="fa fa-lg fa-fw fa-pen"></i></a>';
            $actionDelete = '<button class="btn btn-xs text-danger mx-1" title="Delete" wire:click="confirmDeleteUnit(' . $unitVm->id . ')"><i class="fa fa-lg fa-fw fa-trash"></i></button>';
            $unitVm->buttons = $actionShow . $actionEdit . $actionDelete;

            return $unitVm;
        }, $unitsDS);
    }

    public function confirmDeleteUnit($unitId)
    {
        $this->emit('unitSelected', $unitId);
    }

    public function deleteUnit($unitId)
    {
        $deleteUnitRequest = $this->requestFactory->make(DELETE_UNIT_REQUEST, ['id' => $unitId]);
        $this->deleteUnitUseCase->execute($deleteUnitRequest, function ($response) {
            $this->emit('actionCompleted');
        });
    }

    public function setPageNumber($pageNumber)
    {
        $this->pageNumber = $pageNumber;
        $this->emitSelf("refresh");
    }
}