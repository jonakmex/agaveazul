<?php
namespace App\Domains\Condo\Repository;
use App\Domains\Condo\Entities\Contact;
use App\Models\ContactEloquent;

class ContactEloquentRepository implements ContactRepository {
    public function save(Contact $contact){
        $contactEloquent = new ContactEloquent();
        $contactEloquent->name = $contact->getName();
        $contactEloquent->lastName = $contact->getLastName();
        $contactEloquent->type = $contact->getType();
        $contactEloquent->unit_id = $contact->getUnitId();
        $contactEloquent->save();
        $contact->setId($contactEloquent->id);
    }
    public function update(Contact $contact){
        $contactEloquent = ContactEloquent::findOrFail($contact->getId());
        if($contact->getName() == null){
            $contact->setName($contactEloquent->name);     
        } else{
            $contactEloquent->name = $contact->getName();
        }
        if($contact->getLastName() == null){
            $contact->setLastName($contactEloquent->lastName);     
        } else{
            $contactEloquent->lastName = $contact->getLastName();
        }
        if($contact->getType() == null){
            $contact->setType($contactEloquent->type);     
        } else{
            $contactEloquent->type = $contact->getType();
        }    
        $contact->setUnitId($contactEloquent->unit_id);
        $contactEloquent->save();
        return $contact;
    }
    public function findById($id){
        $contactEloquent = ContactEloquent::findOrFail($id);
        $contact = new Contact();
        $contact->setId($contactEloquent->id);
        $contact->setName($contactEloquent->name);
        $contact->setLastName($contactEloquent->lastName);
        $contact->setType($contactEloquent->type);
        $contact->setUnitId($contactEloquent->unit_id);
        return $contact;
    }
    public function findContactsByCriteria($name, $unit_id, $type, $lastName){
        $contactsEloquent = ContactEloquent::where('name','like','%'.$name.'%', 'and')->where('lastName','like','%'.$lastName.'%', 'and')->where('type','like','%'.$type.'%', 'and')->where('unit_id', '=', $unit_id )->get();
        $contacts = [];

        foreach($contactsEloquent as $contactEloquent) {
            $contact = new Contact();
            $contact->setId($contactEloquent->id);
            $contact->setName($contactEloquent->name);
            $contact->setLastName($contactEloquent->lastName);
            $contact->setType($contactEloquent->type);
            $contact->setUnitId($contactEloquent->unit_id);
            array_push($contacts, $contact);
        }
        return $contacts;
    }

    public function delete($id){
        $contactEloquent = ContactEloquent::findOrFail($id);
        $contact = new Contact;
        $contact->setId($contactEloquent->id);
        $contact->setName($contactEloquent->name);
        $contact->setLastName($contactEloquent->lastName);
        $contact->setType($contactEloquent->type);
        $contact->setUnitId($contactEloquent->unit_id);
        $contactEloquent->delete();

        return $contact;

    }
}