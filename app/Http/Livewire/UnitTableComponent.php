<?php

namespace App\Http\Livewire;

use App\Domains\Shared\Boundary\RequestFactory;
use App\Domains\Shared\UseCase\UseCaseFactory;
use App\Http\Controllers\ViewModel\UnitVm;
use Livewire\Component;

class UnitTableComponent extends Component
{
    public $config;
    public $data;
    public $heads;
    public $description;
    protected $listeners = ['refresh' => 'render'];
    protected $queryString = ['description' => ['except' => '']];

    public function mount(){
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
            'searching' =>false
        ];
    }

    public function render()
    {
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

        $useCaseFactory = app(UseCaseFactory::class);
        $requestFactory = app(RequestFactory::class);

        $useCase = $useCaseFactory->make('App\Domains\Condo\UseCase\FindUnitsByCriteriaUseCase');

        $request = $requestFactory->make(
            'App\Domains\Condo\Boundary\Input\FindUnitsByCriteriaRequest',
            [ 'description' => $this->description ]
        );

        $useCase->execute($request, function($response){
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
            array_push($unitsVm, $unitVm);
        }
        
        return $unitsVm;
    }
}
