<?php

namespace App\Http\Livewire;

use App\Domains\Shared\Boundary\RequestFactory;
use App\Domains\Shared\UseCase\UseCaseFactory;
use Livewire\Component;

class UnitFormCreateComponent extends Component
{
    public $description;

    public function mount(){
    }

    public function render()
    {
        return view('livewire.unit-form-create-component');
    }

    public function save(){
        $this->resetErrorBag();
        $useCaseFactory = app(UseCaseFactory::class);
        $requestFactory = app(RequestFactory::class);
        $request = $requestFactory->make(CREATE_UNIT_REQUEST, ['description'=>$this->description]);
        $useCase = $useCaseFactory->make(CREATE_UNIT_USE_CASE);
        $useCase->execute($request, function($response){

            if(!$response->errors)
                return redirect()->route('unit.index'); 
            
            catchErrors($response->errors,$this->getErrorBag());
        });
    }
}
