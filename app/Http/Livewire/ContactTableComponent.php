<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Domains\Shared\Boundary\RequestFactory;
use App\Domains\Shared\UseCase\UseCaseFactory;
use App\Http\Controllers\ViewModel\ContactVm;

class ContactTableComponent extends Component
{
   

    public $config;
    public $data;
    public $heads;
    public $name;
    public $lastName;
    public $unit_id;
    public $type;

    private $requestFactory;
    private $useCaseFactory;
    private $findContactsByCriteriaUseCase;
    private $deleteContactUseCase;
    protected $listeners = ['deleteContact'=>'deleteContact'];

    public function __construct()
    {
        $this->requestFactory = app(RequestFactory::class);
        $this->useCaseFactory = app(UseCaseFactory::class);
        $this->findContactsByCriteriaUseCase = $this->useCaseFactory->make(FIND_CONTACTS_BY_CRITERIA_USE_CASE);
        $this->deleteContactUseCase = $this->useCaseFactory->make(DELETE_CONTACT_USE_CASE);
        $this->heads = [
            'ID',
            'Name',
            'Last Name',  
            'Type',
            ['label' => 'Actions', 'no-export' => true, 'width'=> '20']
        ];

        $this->config = [
            'ordering' => false,
            'paging'=> false,
            'lengthChange' => false,
            'info'=> false,
            'searching' => false,
            'columns' => [null, null, null, null, ['orderable' => false]],
            'paging' => false
        ];
    }

    public function mount()
    {
        $findContactsByCriteriaRequest = $this->requestFactory->make(FIND_CONTACTS_BY_CRITERIA_REQUEST, [ 
            "name" => "", 
            "lastName" => "", 
            "unit_id"=> $this->unit_id, 
            "type"=>""]);
        $this->findContactsByCriteriaUseCase->execute($findContactsByCriteriaRequest, function($response){
            if($response->errors) 
                $this->data = [];
            else
                $this->data = ContactTableComponent::makeContactVm($response->contactsDS);
        });
    }

    public function render()
    {
        $findContactsByCriteriaRequest = $this->requestFactory->make(FIND_CONTACTS_BY_CRITERIA_REQUEST, [ 
            "name" => $this->name, 
            "lastName" => $this->lastName, 
            "unit_id"=>$this->unit_id, 
            "type"=>$this->type
        ]);

        $this->findContactsByCriteriaUseCase->execute($findContactsByCriteriaRequest, function($response){
            if($response->errors) 
                $this->data = [];
            else
                $this->data = ContactTableComponent::makeContactVm($response->contactsDS);
        });  
        return view('livewire.contact-table-component');
    }

    private static function makeContactVm($contactsDS)
    {
        $contactsVm = [];

        foreach($contactsDS as $contactDS){
            $contactVm = new ContactVm;
            $contactVm->id = $contactDS->id;
            $contactVm->name = $contactDS->name;
            $contactVm->lastName = $contactDS->lastName;
            switch($contactDS->type){
                case "PROPIETARIO":
                    $contactVm->type = 'Propietario';
                    break;
                case "ARRENDATARIO":
                    $contactVm->type = 'Arrendatario';
                    break;
                case "REP_LEGAL":
                    $contactVm->type = 'Representante legal';
                    break;
            }
            $contactVm->buttons = '
            <a href="'.route('contact.show', $contactVm->id).'" class="btn btn-xs text-teal mx-1" title="Show">
                <i class="fa fa-lg fa-fw fa-eye"></i>
            </a>
            <a href="'.route('contact.edit', $contactVm->id).'" class="btn btn-xs text-primary mx-1" title="Edit">
                <i class="fa fa-lg fa-fw fa-pen"></i>
            </a>
            <button class="btn btn-xs text-danger mx-1" title="Delete"'."wire:click='confirmDeleteUnit($contactVm->id)'".' >
            <i class="fa fa-lg fa-fw fa-trash"></i>
            </button>';
            
            array_push($contactsVm, $contactVm);
        }
        return $contactsVm;
    }

    public function confirmDeleteUnit($unitId){
        $this->emit('unitSelected',$unitId);
    }

    public function deleteContact($unitId){
        $deleteContactRequest = $this->requestFactory->make(DELETE_CONTACT_REQUEST,['id'=>$unitId]);
        $this->deleteContactUseCase->execute($deleteContactRequest,function($response){
            $this->emit('actionCompleted');
        });
    }
}
