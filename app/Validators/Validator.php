<?php
namespace App\Validators;

use App\DS\Request;

interface Validator 
{
    public function validate(Request $request);
}