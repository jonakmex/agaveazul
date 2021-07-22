<?php
namespace App\Boundary;

abstract class InputPort {
    public abstract function validate();
}