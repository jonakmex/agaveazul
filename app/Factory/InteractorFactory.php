<?php
namespace App\Factory;

class InteractorFactory {
    public static function make($interactorName) {
        return new $interactorName;
    }
}