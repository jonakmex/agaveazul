<?php
namespace App\Interactors\Ports;


class InputFactory
{
    protected static $base = 'App\Interactors\Ports\Input';
    public static function make($inputName,$params){
        $class = InputFactory::$base.'\\'.$inputName;
        $instance = new $class();
        $reflector = new \ReflectionClass($instance);
        $properties = $reflector->getProperties();
        foreach($properties as $property)
        {
            if(array_key_exists($property->getName(),$params))
                $instance->{$property->getName()} = $params[$property->getName()];
        }
        return $instance;
    }
}