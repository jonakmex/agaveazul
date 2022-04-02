<?php

namespace App\Domains\Condo\Entities;

class Asset {
    private $id;
    private $unitId;
    private $type;
    private $description;

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getUnitId(){
        return $this->unitId;
    }

    public function setUnitId($unitId){
        $this->unitId = $unitId;
    }

    public function getType(){
        return $this->type;
    }
    
    public function setType($type){
        $this->type = $type;
    }

    public function getDescription(){
        return $this->description;
    }

    public function setDescription($description){
        $this->description = $description;
    }
}