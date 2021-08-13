<?php
namespace App\Interactor;

use App\Boundary\InputPort;


abstract class Interactor {
    abstract public function execute(InputPort $inputPort);
}