<?php
namespace App\Domains\Finances\Entities;

class Account {
    private $balance;

    public function setBalance($balance){
        $this->balance = $balance;
    }

    public function getBalance(){
        return $this->balance;
    }
}