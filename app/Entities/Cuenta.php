<?php
namespace App\Entities;

class Cuenta {
    private $balance;


    public function getSaldo(){
        return $this->balance;
    }

    public function addBalance($balance){
        $this->balance += $balance; 
    }
}