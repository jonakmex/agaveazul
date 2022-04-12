<?php

namespace App\Http\Livewire;

use App\Domains\Shared\Boundary\RequestFactory;
use App\Domains\Shared\UseCase\UseCaseFactory;
use Livewire\Component;

class UnitFormCreateComponent extends Component
{
    public $description;
    public $created;
    public $errors;

    public function mount(){
        $this->created = false;
    }

    public function render()
    {
        return view('livewire.unit-form-create-component');
    }

    public function save(){
        $this->created = false;
        $useCaseFactory = app(UseCaseFactory::class);
        $requestFactory = app(RequestFactory::class);
        $request = $requestFactory->make('App\Domains\Condo\Boundary\Input\CreateUnitRequest', ['description'=>$this->description]);
        $useCase = $useCaseFactory->make('App\Domains\Condo\UseCase\CreateUnitUseCase');
        $useCase->execute($request, function($response){
            if(property_exists($response, 'unitDS')){
                $this->resetValidation();
                $this->reset('description');
                $this->emitTo('table-unit-component','refresh');
                $this->created = true;
            } else {
                $this->created = false;
                $this->validate(
                    ['description'=>'required|max:10'],
                    ['required'=> $response->errors[0]['description'], 'max' => $response->errors[0]['description']]
                );
            }
        });
    }
}
