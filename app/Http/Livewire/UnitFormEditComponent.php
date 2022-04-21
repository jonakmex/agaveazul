<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Domains\Shared\UseCase\UseCaseFactory;
use App\Domains\Shared\Boundary\RequestFactory;

class UnitFormEditComponent extends Component
{
    public $unitId;
    public $description;
    
    public function render()
    {
        return view('livewire.unit-form-edit-component');
    }

    public function update()
    {
        $this->resetErrorBag();
        $useCaseFactory = app(UseCaseFactory::class);
        $requestFactory = app(RequestFactory::class);
        $request = $requestFactory->make(EDIT_UNIT_REQUEST, ['id'=>$this->unitId, 'description'=>$this->description]);
        $useCase = $useCaseFactory->make(EDIT_UNIT_USE_CASE);
        $useCase->execute($request, function($response){
            if(!$response->errors){
                return redirect()->route('unit.index'); 
            }
            else{
                foreach($response->errors as $error){
                    foreach($error as $field => $message){
                        $this->addError($field, __("messages.$message"));
                    }
                }
            }
        });
    }
}
