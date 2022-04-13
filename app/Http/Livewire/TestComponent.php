<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Domains\Shared\Boundary\RequestFactory;
use App\Domains\Shared\UseCase\UseCaseFactory;
use App\Http\Controllers\ViewModel\UnitVm;

define("FIND_UNITS_BY_CRITERIA_USE_CASE","App\Domains\Condo\UseCase\FindUnitsByCriteriaUseCase");
define("FIND_UNITS_BY_CRITERIA_REQUEST","App\Domains\Condo\Boundary\Input\FindUnitsByCriteriaRequest");

define("DELETE_UNIT_USE_CASE","App\Domains\Condo\UseCase\DeleteUnitUseCase");
define("DELETE_UNIT_REQUEST","App\Domains\Condo\Boundary\Input\DeleteUnitRequest");

class TestComponent extends Component
{
    public $heads;
    public $config;
    public $data;
    public $description;
    
    private $requestFactory;
    private $useCaseFactory;
    private $findUnitsByCriteriaUseCase;
    private $deleteUnitUseCase;
    protected $listeners = ['deleteUnit'=>'deleteUnit'];

    public function __construct()
    {
        $this->requestFactory = app(RequestFactory::class);
        $this->useCaseFactory = app(UseCaseFactory::class);
        $this->findUnitsByCriteriaUseCase = $this->useCaseFactory->make(FIND_UNITS_BY_CRITERIA_USE_CASE);
        $this->deleteUnitUseCase = $this->useCaseFactory->make(DELETE_UNIT_USE_CASE);
        $this->heads = [
            'ID',
            'Description',
            ['label' => 'Actions', 'no-export' => true, 'width' => 10],
        ];
        $this->config = [
            'order' => [],
            'columns' => [null, null,null]
        ];
    }

    public function mount()
    {
        $findUnitsByCriteriaRequest = $this->requestFactory->make(FIND_UNITS_BY_CRITERIA_REQUEST, 
                            ["description" => ""]);
        $this->findUnitsByCriteriaUseCase->execute($findUnitsByCriteriaRequest, function($response){
            if($response->errors) 
                $this->data = [];
            else
                $this->data = TestComponent::createUnitsVm($response->unitsDS); 
        });
    }
    
    public function render(){
        $findUnitsByCriteriaRequest = $this->requestFactory->make(FIND_UNITS_BY_CRITERIA_REQUEST, 
                            ["description" => $this->description]);
        $this->findUnitsByCriteriaUseCase->execute($findUnitsByCriteriaRequest, function($response){
            if($response->errors) 
                $this->data = [];
            else
                $this->data = TestComponent::createUnitsVm($response->unitsDS); 
        });  

        return view('livewire.test-component');
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

    public static function createUnitsVm($unitsDS){
        $unitsVm = [];
        foreach($unitsDS as $unitDS){
            $unitVm = new UnitVm;
            $unitVm->id = $unitDS->id;
            $unitVm->description = $unitDS->description;
            $editRoute = route('unit.edit',$unitDS->id);
            $actionEdit = '<a href="'.$editRoute.'" class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
            <i class="fa fa-lg fa-fw fa-pen"></i>
            </a>';
            $actionDelete = '<button class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete" '."wire:click='confirmDeleteUnit($unitVm->id)'".' >
                                <i class="fa fa-lg fa-fw fa-trash"></i>
                            </button>';
            $unitVm->actions = $actionEdit.$actionDelete;
            array_push($unitsVm,$unitVm);
        }
        return $unitsVm;
    }
}
