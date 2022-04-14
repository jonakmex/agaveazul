<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Domains\Shared\UseCase\UseCaseFactory;
use App\Domains\Shared\Boundary\RequestFactory;

class UnitFormEditComponent extends Component
{
    public $unitId;
    public $description;
    public $success;
    public $error;

    public function mount($unitId, $description)
    {
        $this->unitId = $unitId;
        $this->description = $description;
    }

    public function render()
    {
        return view('livewire.unit-form-edit-component');
    }

    public function update()
    {
        $useCaseFactory = app(UseCaseFactory::class);
        $requestFactory = app(RequestFactory::class);
        $request = $requestFactory->make(
            'App\Domains\Condo\Boundary\Input\EditUnitRequest',
            ['id' => $this->unitId, 'description' => $this->description]
        );
        $useCase = $useCaseFactory->make('App\Domains\Condo\UseCase\EditUnitUseCase');
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
                $this->emitTo('table-unit-component', 'refresh');
            }
        });
    }
}
