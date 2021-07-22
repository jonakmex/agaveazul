<?php
namespace App\Interactor;

use App\Boundary\InputPort;
use App\Boundary\Callback;


abstract class Interactor {
    abstract public function execute(InputPort $inputPort,Callback $callback);
}