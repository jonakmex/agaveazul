<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Domains\Shared\Boundary\RequestFactory;
use App\Domains\Shared\UseCase\UseCaseFactory;
use App\Http\Controllers\ViewModel\UnitVm;

class TestComponent extends Component
{
    public $heads;
    public $config;
    public $data;
    public $description;
    private $findUnitsByCriteriaUseCase;
    private $requestFactory;

    public function mount()
    {
        $this->requestFactory = app(RequestFactory::class);
        $useCaseFactory = app(UseCaseFactory::class);
        $this->findUnitsByCriteriaUseCase = $useCaseFactory->make('App\Domains\Condo\UseCase\FindUnitsByCriteriaUseCase');
        $findUnitsByCriteriaRequest = $this->requestFactory->make("App\Domains\Condo\Boundary\Input\FindUnitsByCriteriaRequest", 
                            ["description" => ""]);
        $this->findUnitsByCriteriaUseCase->execute($findUnitsByCriteriaRequest, function($response){
            if($response->errors) 
                $this->data = [];
            else
                $this->data = TestComponent::createUnitsVm($response->unitsDS); 
        });

        $this->heads = [
            'ID',
            'Description',
            ['label' => 'Actions', 'no-export' => true, 'width' => 10],
        ];

        $this->config = [
            'data' => $this->data,
            'order' => [],
            'columns' => [null, null,null]
        ];
    }
    
    public function refresh(){
        $this->requestFactory = app(RequestFactory::class);
        $useCaseFactory = app(UseCaseFactory::class);
        $this->findUnitsByCriteriaUseCase = $useCaseFactory->make('App\Domains\Condo\UseCase\FindUnitsByCriteriaUseCase');
        $findUnitsByCriteriaRequest = $this->requestFactory->make("App\Domains\Condo\Boundary\Input\FindUnitsByCriteriaRequest", 
                            ["description" => $this->description]);
        $this->findUnitsByCriteriaUseCase->execute($findUnitsByCriteriaRequest, function($response){
            if($response->errors) 
                $this->data = [];
            else
                $this->data = TestComponent::createUnitsVm($response->unitsDS); 
        });
        $this->heads = [
            'ID',
            'Description',
            ['label' => 'Actions', 'no-export' => true, 'width' => 10],
        ];

        $this->config = [
            'data' => $this->data,
            'order' => [],
            'columns' => [null, null,null]
        ];
    }


    public static function createUnitsVm($unitsDS){
        $unitsVm = [];
        foreach($unitsDS as $unitDS){
            $unitVm = new UnitVm;
            $unitVm->id = $unitDS->id;
            $unitVm->description = $unitDS->description;
            $editRoute = route('unit.edit',$unitDS->id);
            $deleteRoute = route('unit.destroy',$unitDS->id);
            $actionEdit = '<a href="'.$editRoute.'" class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
            <i class="fa fa-lg fa-fw fa-pen"></i>
            </a>';
            $actionDelete = '<button class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete" data-toggle="modal" data-target="#'.$unitVm->id.'">
            <i class="fa fa-lg fa-fw fa-trash"></i>
        </button>';
            $unitVm->actions = $actionEdit.$actionDelete;
            array_push($unitsVm,$unitVm);
        }
        return $unitsVm;
    }
}
