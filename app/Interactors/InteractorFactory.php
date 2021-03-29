<?php

namespace App\Interactors;

class InteractorFactory
{
    protected static $base = 'App\Interactors';

    public static function make($interactorName){
        $class = InteractorFactory::$base.'\\'.$interactorName;
        return new $class();
    }
}