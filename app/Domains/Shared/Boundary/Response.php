<?php

namespace App\Domains\Shared\Boundary;

class Response {
    public $errors;

    public static function makeFailResponse($errors){
        $fail = new Response;
        $fail->errors = $errors;
        return $fail;
    }
}