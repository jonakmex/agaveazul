<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Domains\Shared\UseCase\UseCaseFactory;
use App\Domains\Shared\Boundary\RequestFactory;

class UnitFormEditComponent extends Component
{
    public $unit;
    public $description;
    public $updated;

    public function mount($unit)
    {
        $this->unit = $unit;
        $this->description = $unit['description'];
    }
    
    public function render()
    {
        return view('livewire.unit-form-edit-component');
    }

    public function update(){
        $useCaseFactory = app(UseCaseFactory::class);
        $requestFactory = app(RequestFactory::class);
        $request = $requestFactory->make(
            'App\Domains\Condo\Boundary\Input\EditUnitRequest', 
            [ 'id'=>$this->unit['id'], 'description'=> $this->description]
        );
        $useCase = $useCaseFactory->make('App\Domains\Condo\UseCase\EditUnitUseCase');
        $useCase->execute($request, function($response){
            if(property_exists($response,'unitDS')){  
                $this->resetValidation();
                $this->emitTo('table-unit-component','refresh');
                $this->updated = true;
            } else{
                $this->updated = false;
                $this->validate(
                    ['description'=>'required|max:10'],
                    ['required'=> $response->errors[0]['description'], 'max' => $response->errors[0]['description']]
                );
            }
        });
    }
}
