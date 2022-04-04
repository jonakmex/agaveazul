<?php
namespace App\Domains\Condo\Repository;
use App\Domains\Condo\Entities\Contact;

interface ContactRepository {
    public function save(Contact $contact);
    public function update(Contact $contact);
    public function findById($id);
    public function findContactsByCriteria($name, $unit_id, $type, $lastName);
    public function delete($id);
}