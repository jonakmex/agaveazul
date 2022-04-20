<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Domains\Shared\UseCase\UseCaseFactory;
use App\Domains\Shared\Boundary\RequestFactory;

class ContactFormCreateComponent extends Component
{
    public $name;
    public $lastName;
    public $type;
    public $unit_id;
    public $created;
    public $errors;

    public function mount(){
        $this->created = false;
    }

    public function render()
    {
        return view('livewire.contact-form-create-component');
    }

    public function save(){
        $this->created = false;
        $useCaseFactory = app(UseCaseFactory::class);
        $requestFactory = app(RequestFactory::class);
        $request = $requestFactory->make(CREATE_CONTACT_REQUEST, [
            'name'=>$this->name, 
            'lastName'=>$this->lastName, 
            'type'=> $this->type, 
            'unit_id'=> $this->unit_id]);
        $useCase = $useCaseFactory->make(CREATE_CONTACT_USE_CASE);
        $useCase->execute($request, function($response){
            if (!$response->errors) {
                return redirect()->route('contact.index', ["unit_id"=>$response->contactDS->unit_id]);
                
            } else {
                foreach($response->errors as $error){
                    foreach($error as $field => $message){
                        $this->addError($field, __("messages.$message"));
                    }
                }
            }
        });
    }
}
