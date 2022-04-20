<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Domains\Shared\UseCase\UseCaseFactory;
use App\Domains\Shared\Boundary\RequestFactory;


class ContactFormEditComponent extends Component
{
    public $contactId;
    public $contact;
    public $name;
    public $lastName;
    public $unit_id;
    public $types;
    public $type;
    public $typeKey;
    public $success;
    public $updated;

    private $useCaseFactory;
    private $requestFactory;
    private $editContactUseCase;

    

    public function __construct()
    {
        $this->useCaseFactory = app(UseCaseFactory::class);
        $this->requestFactory = app(RequestFactory::class);
        $this->editContactUseCase = $this->useCaseFactory->make(EDIT_CONTACT_USE_CASE);
    }

    public function mount($contact, $types)
    {
        $this->contactId = $contact['id'];
        $this->unit_id = $contact['unit_id'];
        $this->name = $contact['name'];
        $this->lastName = $contact['lastName'];
        $this->type = $contact['type'];
        $this->typeKey = $contact['typeKey'];
        $this->types = $types;
    }


    public function update()
    {
        $this->success = false;
        $editContactRequest = $this->requestFactory->make(EDIT_CONTACT_REQUEST, [
            'id' => $this->contactId,
            'name' => $this->name,
            'lastName' => $this->lastName,
            'type' => $this->typeKey
        ]);
        $this->editContactUseCase->execute($editContactRequest,  function ($response) {
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

    public function render()
    {
        return view('livewire.contact-form-edit-component');
    }

    
}
