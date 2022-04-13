<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Domains\Shared\Boundary\RequestFactory;
use App\Domains\Shared\UseCase\UseCaseFactory;
use App\Http\Controllers\ViewModel\UnitVm;

// define("FIND_UNITS_BY_CRITERIA_USE_CASE","App\Domains\Condo\UseCase\FindUnitsByCriteriaUseCase");
// define("FIND_UNITS_BY_CRITERIA_REQUEST","App\Domains\Condo\Boundary\Input\FindUnitsByCriteriaRequest");
// define("DELETE_UNIT_USE_CASE","App\Domains\Condo\UseCase\DeleteUnitUseCase");
// define("DELETE_UNIT_REQUEST","App\Domains\Condo\Boundary\Input\DeleteUnitRequest");

class UnitTableComponent extends Component
{
    const FIND_UNITS_BY_CRITERIA_USE_CASE = "App\Domains\Condo\UseCase\FindUnitsByCriteriaUseCase";
    const DELETE_UNIT_USE_CASE = "App\Domains\Condo\UseCase\DeleteUnitUseCase";
    const DELETE_UNIT_REQUEST = "App\Domains\Condo\Boundary\Input\DeleteUnitRequest";
    const FIND_UNITS_BY_CRITERIA_REQUEST = "App\Domains\Condo\Boundary\Input\FindUnitsByCriteriaRequest";

    public $config;
    public $data;
    public $heads;
    public $description;
    // protected $listeners = ['refresh' => 'render'];
    protected $queryString = ['description' => ['except' => '']];

    private $requestFactory;
    private $useCaseFactory;
    private $findUnitsByCriteriaUseCase;
    private $deleteUnitUseCase;
    protected $listeners = ['deleteUnit'=>'deleteUnit'];

    public function __construct()
    {
        $this->requestFactory = app(RequestFactory::class);
        $this->useCaseFactory = app(UseCaseFactory::class);
        $this->findUnitsByCriteriaUseCase = $this->useCaseFactory->make(self::FIND_UNITS_BY_CRITERIA_USE_CASE);
        $this->deleteUnitUseCase = $this->useCaseFactory->make(self::DELETE_UNIT_USE_CASE);
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
    }

    public function mount()
    {
        $findUnitsByCriteriaRequest = $this->requestFactory->make(self::FIND_UNITS_BY_CRITERIA_REQUEST, ["description" => ""]);
        $this->findUnitsByCriteriaUseCase->execute($findUnitsByCriteriaRequest, function($response){
            if($response->errors) 
                $this->data = [];
            else
                $this->data = UnitTableComponent::makeUnitVm($response->unitsDS);
        });
    }

    public function render()
    {
        $findUnitsByCriteriaRequest = $this->requestFactory->make(self::FIND_UNITS_BY_CRITERIA_REQUEST, ["description" => $this->description]);

        $this->findUnitsByCriteriaUseCase->execute($findUnitsByCriteriaRequest, function($response){
            if($response->errors) 
                $this->data = [];
            else
                $this->data = UnitTableComponent::makeUnitVm($response->unitsDS);
        });  

        return view('livewire.unit-table-component');
    }

    private static function makeUnitVm($unitsDS){
        $unitsVm = [];
        foreach($unitsDS as $unitDS){
            $unitVm = new UnitVm;
            $unitVm->id = $unitDS->id;
            $unitVm->description = $unitDS->description;
            $actionEdit = '
            <a href="'.route('unit.edit',$unitDS->id).'" class="btn btn-xs text-primary mx-1" title="Edit">
                <i class="fa fa-lg fa-fw fa-pen"></i>
            </a>';
            $actionDelete = '
            <button class="btn btn-xs text-danger mx-1" title="Delete"'."wire:click='confirmDeleteUnit($unitVm->id)'".' >
                <i class="fa fa-lg fa-fw fa-trash"></i>
            </button>';
            $actionShow = '
            <a href="'.route('unit.show',$unitDS->id).'" class="btn btn-xs text-teal mx-1" title="Show">
                <i class="fa fa-lg fa-fw fa-eye"></i>
            </a>';
            $unitVm->buttons = $actionShow.$actionEdit.$actionDelete;
            array_push($unitsVm, $unitVm);
        }
        
        return $unitsVm;
    }

    public function confirmDeleteUnit($unitId){
        $this->emit('unitSelected',$unitId);
    }

    public function deleteUnit($unitId){
        $deleteUnitRequest = $this->requestFactory->make(self::DELETE_UNIT_REQUEST,['id'=>$unitId]);
        $this->deleteUnitUseCase->execute($deleteUnitRequest,function($response){
            $this->emit('actionCompleted');
        });
    }
}