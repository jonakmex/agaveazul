<?php
namespace App\Boundary\Output\Unit;

use App\Boundary\OutputPort;
use App\Models\Unit;

class LoadUnitForEditionOutputPort extends OutputPort {
    public Unit $unit;
}