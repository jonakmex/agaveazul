<?php

namespace App\Factories;

class InteractorFactory
{
    static $base = 'App\Interactor\\';
    public static function make($interactorName){
        $class = new \ReflectionClass(InteractorFactory::$base.$interactorName);
        return $class->newInstanceArgs();
    }
}