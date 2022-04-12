<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Domains\Shared\UseCase\UseCaseFactory;
use App\Domains\Shared\Boundary\RequestFactory;

class UnitModalDeleteComponent extends Component
{
    public $unitId;
    public $unitDescription;

    public function mount($unitId, $unitDescription){
        $this->unitId = $unitId;
        $this->unitDescription = $unitDescription;
    }

    public function render()
    {
        return view('livewire.unit-modal-delete-component');
    }

    public function delete(){
        $useCaseFactory = app(UseCaseFactory::class);
        $requestFactory = app(RequestFactory::class);
        $deleteUnitRequest = $requestFactory->make("App\Domains\Condo\Boundary\Input\DeleteUnitRequest", ["id"=> $this->unitId]);
        $useCase = $useCaseFactory->make('App\Domains\Condo\UseCase\DeleteUnitUseCase');
        $useCase->execute($deleteUnitRequest, function($response){
            if(property_exists($response, 'unitDS')){
                $this->emitTo('unit-table-component','refresh');
            }
        }); 
    }
}
