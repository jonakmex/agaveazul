<?php

namespace App\Domains\Finances\Boundary\Input;

use App\Domains\Shared\Boundary\Request;

class TransferRequest extends Request{

    public $sourceAccount;
    public $targetAccount;
    public $amount;

    public function validate(){

    }
}