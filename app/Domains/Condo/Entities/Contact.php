<?php

namespace App\Domains\Condo\Entities;

class Contact {
    private $id;
    private $name;
    private $lastName;
    private $type;
    private $unit_id;

    function getId(){
        return $this->id;
    }
    function setId($id){
        $this->id = $id;
    }

    function getUnitId(){
        return $this->unit_id;
    }
    function setUnitId($unit_id){
        $this->unit_id = $unit_id;
    }

    function getName(){
        return $this->name;
    }
    function setName($name){
        $this->name = $name;
    }

    function getLastName(){
        return $this->lastName;
    }
    function setLastName($lastName){
        $this->lastName = $lastName;
    }

    function getType(){
        return $this->type;
    }
    function setType($type){
        $this->type = $type;
    }
}