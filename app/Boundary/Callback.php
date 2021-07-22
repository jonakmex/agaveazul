<?php
namespace App\Boundary;


abstract class Callback {
    abstract public function callback(OutputPort $output);
}