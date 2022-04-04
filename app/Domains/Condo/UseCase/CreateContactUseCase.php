<?php

namespace App\Domains\Condo\UseCase;


use App\Domains\Shared\UseCase\UseCase;
use App\Domains\Shared\Boundary\Request;
use App\Domains\Shared\Boundary\Response;
use App\Domains\Condo\Repository\ContactRepository;
use App\Domains\Condo\Boundary\Output\CreateContactResponse;
use App\Domains\Condo\Boundary\DataStructure\ContactDS;
use App\Domains\Condo\Entities\Contact;

class CreateContactUseCase implements UseCase{

    private ContactRepository $contactRepository;

    public function __construct(ContactRepository $contactRepository){
        $this->contactRepository = $contactRepository;
    }

    public function execute(Request $request,$callback){
        $errors = $request->validate();
        if(!empty($errors))
            return $callback(Response::makeFailResponse($errors));
            
        $contact = $this->makeContact($request);
        $this->contactRepository->save($contact);

        if($callback != null)
            return $callback($this->makeResponse($contact));
    }

    private function makeContact(Request $request){
        $contact = new Contact;
        $contact->setName($request->name);
        $contact->setLastName($request->lastName);
        $contact->setType($request->type);
        $contact->setUnitId($request->unit_id);
        return $contact;
    }

    private function makeResponse(Contact $contact){
        $response = new CreateContactResponse;
        $contactDS = new ContactDS;
        $contactDS->id = $contact->getId();
        $contactDS->name = $contact->getName();
        $contactDS->lastName = $contact->getLastName();
        $contactDS->type = $contact->getType();
        $contactDS->unit_id = $contact->getUnitId();
        $response->contactDS = $contactDS;

        return $response;
    }
}