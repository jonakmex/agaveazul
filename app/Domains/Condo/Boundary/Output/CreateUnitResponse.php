<?php
namespace App\Domains\Condo\Boundary\Output;

use App\Domains\Shared\Boundary\Response;
use App\Domains\Condo\Boundary\DataStructure\UnitDS;

class CreateUnitResponse extends Response {
    public UnitDS $unitDS;
}