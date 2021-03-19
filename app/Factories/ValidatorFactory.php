<?php

namespace App\Factories;

class ValidatorFactory {
    protected static $base = 'App\Validators\\';
    public static function make($validatorName){
        $class = new \ReflectionClass(ValidatorFactory::$base.$validatorName);
        return $class->newInstanceArgs();
    }
}