<?php
namespace App\Domains\Shared\Entities;

class Order {
    private $orderBy;
    private $orderDirection;

    public function getOrderBy(){
        return $this->orderBy;
    }
    public function setOrderBy($orderBy){
        $this->orderBy = $orderBy;
    }
    
    public function getOrderDirection(){
        return $this->orderDirection;
    }
    public function setOrderDirection($orderDirection){
        $this->orderDirection = $orderDirection;
    }
}