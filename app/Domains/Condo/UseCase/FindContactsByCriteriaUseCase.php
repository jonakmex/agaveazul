<?php

namespace App\Domains\Condo\UseCase;


use App\Domains\Shared\UseCase\UseCase;
use App\Domains\Shared\Boundary\Request;
use App\Domains\Shared\Boundary\Response;
use App\Domains\Condo\Repository\ContactRepository;
use App\Domains\Condo\Boundary\Output\FindContactsByCriteriaResponse;
use App\Domains\Condo\Boundary\DataStructure\ContactDS;


class FindContactsByCriteriaUseCase implements UseCase{

    private ContactRepository $contactRepository;

    public function __construct(ContactRepository $contactRepository){
        $this->contactRepository = $contactRepository;
    }

    public function execute(Request $request,$callback){
        $errors = $request->validate();
        if(!empty($errors))
            return $callback(Response::makeFailResponse($errors));

       $contacts = $this->contactRepository->findContactsByCriteria($request->name, $request->unit_id, $request->type, $request->lastName);

        if($callback != null)
            return $callback($this->makeResponse($contacts));
    }


    private function makeResponse($contacts){
        $response = new FindContactsByCriteriaResponse;
        $response->contactsDS = [];

        foreach($contacts as $contact) {
            $contactDS = new ContactDS;
            $contactDS->id = $contact->getId();
            $contactDS->name = $contact->getName();
            $contactDS->lastName = $contact->getLastName();
            $contactDS->type = $contact->getType();
            $contactDS->unit_id = $contact->getUnitId();
            array_push($response->contactsDS,$contactDS);
        }

        return $response;
    }
}