<?php

namespace Tests\Feature\Condo\Repository;
use App\Domains\Condo\Repository\ContactRepository;
use App\Domains\Condo\Entities\Contact;

class ContactRepositoryMock implements ContactRepository{
    public function save(Contact $contact){
        echo "Saving mock";
        $random_base64 = base64_encode(random_bytes(18));
        $contact->setId(serialize($random_base64));
        return $contact;
    }

    public function update(Contact $contact){
        echo "updating contact";

        $contactUpdated = new Contact; 
        $contactUpdated->setId($contact->getId());
        $contactUpdated->setName($contact->getName());
        $contactUpdated->setLastName($contact->getLastName());
        $contactUpdated->setType($contact->getType());

        return $contact;
    }
    public function findById($id){
        echo "searching contact in repo";
        $contact = new Contact; 
        $contact->setId($id);
        $contact->setName("Jorge");
        $contact->setLastName("Sosa");
        $contact->setType("PROPIETARIO");

        return $contact;

    }
    public function findContactsByCriteria($name, $lastname, $unit_id, $type){
        $all = [];

        if($name == "noexiste") return $all;
        
        for ($i=0; $i < 5; $i++) { 
            $contact = new Contact;
            $contact->setId($i);
            $contact->setName("Jorge  ".$i);
            array_push($all, $contact);
        }

        return $all;

    }
    public function delete($id){
        $contactMock = new Contact;
        $contactMock->setId($id);
        $contactMock->setName("Jorge");
        $contactMock->setLastName("Sosa");
        $contactMock->setType("PROPIETARIO");
        echo "removing unit";

        return $contactMock;
    }


}