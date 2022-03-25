<?php
namespace App\Domains\Condo\Boundary\Output;

use App\Domains\Shared\Boundary\Response;
use App\Domains\Condo\Boundary\DataStructure\UnitDS;

class FindUnitByIdResponse extends Response {
    public UnitDS $unitDS;
}