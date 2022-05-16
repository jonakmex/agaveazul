<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Domains\Shared\Boundary\RequestFactory;
use App\Domains\Shared\UseCase\UseCaseFactory;
use App\Http\Controllers\ViewModel\UnitVm;
use App\Domains\Shared\Boundary\DS\PaginationDS;
use App\Domains\Shared\Boundary\DS\OrderDS;




class UnitTableComponent extends Component
{
    public $config;
    public $data;
    public $heads;
    public $description;
    public $numRecordsPerPage = 10;
    public $pageNumber = 1; 
    public $orderBy = "id";
    public $orderDirection = "asc";
    public $numberOfPages;
   
    
   
    protected $queryString = ['description' => ['except' => '']];
    protected $listeners = ['deleteUnit', 'refresh' => 'render'];

    private $requestFactory;
    private $useCaseFactory;
    private $findUnitsByCriteriaUseCase;
    private $deleteUnitUseCase;
    private $paginateDS;
    private $orderDS;
   

    public function __construct()
    {
        $this->requestFactory = app(RequestFactory::class);
        $this->useCaseFactory = app(UseCaseFactory::class);
        $this->findUnitsByCriteriaUseCase = $this->useCaseFactory->make(FIND_UNITS_BY_CRITERIA_USE_CASE);
        $this->deleteUnitUseCase = $this->useCaseFactory->make(DELETE_UNIT_USE_CASE);

        $this->heads = [
            'ID',
            'Description',
            ['label' => 'Actions', 'no-export' => true, 'width'=> '20']
        ];

        $this->config = [
            'ordering' => false,
            'paging'=> false,
            'lengthChange' => false,
            'info'=> false,
            'searching' => false,
        ];

        $this->paginateDS = new PaginationDS; 
        $this->orderDS = new OrderDS; 
       
    }

    // public function mount()
    // {
        
    //     $this->paginateDS->numRecordsPerPage = $this->numRecordsPerPage;
    //     $this->paginateDS->pageNumber = $this->pageNumber;
    //     $this->orderDS->orderBy = $this->orderBy;
    //     $this->orderDS->orderDirection = $this->orderDirection;
    //     $findUnitsByCriteriaRequest = $this->requestFactory->make(FIND_UNITS_BY_CRITERIA_REQUEST, [
    //         "description" => $this->description,
    //         "pagination" => $this->paginateDS,
    //         "order" => $this->orderDS 
    //          ]);
    //     $this->findUnitsByCriteriaUseCase->execute($findUnitsByCriteriaRequest, function($response){
    //         if($response->errors) 
    //             $this->data = [];
    //         else
    //             $this->data = UnitTableComponent::makeUnitVm($response->unitsDS);
               
    //     });
    // }

    public function render()
    {
        $this->paginateDS->numRecordsPerPage = $this->numRecordsPerPage;
        $this->paginateDS->pageNumber = $this->pageNumber;
        $this->orderDS->orderBy = $this->orderBy;
        $this->orderDS->orderDirection = $this->orderDirection;
        $findUnitsByCriteriaRequest = $this->requestFactory->make(FIND_UNITS_BY_CRITERIA_REQUEST, [
            "description" => $this->description,
            "pagination" => $this->paginateDS,
            "order" => $this->orderDS]);

        $this->findUnitsByCriteriaUseCase->execute($findUnitsByCriteriaRequest, function($response){
            if($response->errors) 
                $this->data = [];
            else
                $this->data = UnitTableComponent::makeUnitVm($response->unitsDS);
                $this->numberOfPages = $response->numberOfPages;  
                
        });  

        return view('livewire.unit-table-component');
    }

    private static function makeUnitVm($unitsDS){
        $unitsVm = [];
        foreach($unitsDS as $unitDS){
            $unitVm = new UnitVm;
            $unitVm->id = $unitDS->id;
            $unitVm->description = $unitDS->description;
            $actionShow = '
            <a href="'.route('unit.show',$unitDS->id).'" class="btn btn-xs text-teal mx-1" title="Show">
                <i class="fa fa-lg fa-fw fa-eye"></i>
            </a>';
            $actionEdit = '
            <a href="'.route('unit.edit',$unitDS->id).'" class="btn btn-xs text-primary mx-1" title="Edit">
                <i class="fa fa-lg fa-fw fa-pen"></i>
            </a>';
            $actionDelete = '
            <button class="btn btn-xs text-danger mx-1" title="Delete"'."wire:click='confirmDeleteUnit($unitVm->id)'".' >
                <i class="fa fa-lg fa-fw fa-trash"></i>
            </button>';
            $unitVm->buttons = $actionShow.$actionEdit.$actionDelete;
            array_push($unitsVm, $unitVm);
        }
        
        return $unitsVm;
    }

    public function confirmDeleteUnit($unitId){
        $this->emit('unitSelected',$unitId);
    }

    public function deleteUnit($unitId){
        $deleteUnitRequest = $this->requestFactory->make(DELETE_UNIT_REQUEST,['id'=>$unitId]);
        $this->deleteUnitUseCase->execute($deleteUnitRequest,function($response){
            $this->emit('actionCompleted');
        });
    }

    public function setPageNumber($pageNumber){
        $this->pageNumber = $pageNumber;
        $this->render();
    }

 
}