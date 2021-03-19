<?php

namespace App\Factories;

use ReflectionProperty;

class RequestFactory
{
    protected static $base = 'App\DS\Request\\';

    public static function make($requestName,$params){
        $class = new \ReflectionClass(RequestFactory::$base.$requestName);
        $request = $class->newInstanceArgs();
        $props   = $class->getProperties(ReflectionProperty::IS_PUBLIC | ReflectionProperty::IS_PROTECTED);
        foreach ($props as $prop) {
            $prop->setValue($request,$params[$prop->getName()]);
        }
        
        return $request;
    }
}