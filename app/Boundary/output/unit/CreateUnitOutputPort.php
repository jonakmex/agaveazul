<?php
namespace App\Boundary\Output\Unit;

use App\Boundary\OutputPort;
use App\Models\Unit;

class CreateUnitOutputPort extends OutputPort {
   public Unit $unit;
}