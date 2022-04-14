<?php

namespace App\Http\Livewire;

use App\Domains\Shared\Boundary\RequestFactory;
use App\Domains\Shared\UseCase\UseCaseFactory;
use Livewire\Component;

class UnitFormCreateComponent extends Component
{
    public $description;
    public $success;
    public $error;

    public function render()
    {
        return view('livewire.unit-form-create-component');
    }

    public function store()
    {
        $this->success = false;
        $useCaseFactory = app(UseCaseFactory::class);
        $requestFactory = app(RequestFactory::class);
        $request = $requestFactory->make('App\Domains\Condo\Boundary\Input\CreateUnitRequest', ['description' => $this->description]);
        $useCase = $useCaseFactory->make('App\Domains\Condo\UseCase\CreateUnitUseCase');

        $useCase->execute($request, function ($response) {
            if ($response->errors) {
                $this->success = false;
                $this->error = true;
                $this->validate(
                    ['description' => 'required|max:10'],
                    ['required' => $response->errors[0]['description'], 'max' => $response->errors[0]['description']]
                );
            } else {
                $this->success = true;
                $this->error = false;
                $this->resetValidation();
                $this->reset('description');
                $this->emitTo('unit-table-component', 'refresh');
            }
        });
    }
}
