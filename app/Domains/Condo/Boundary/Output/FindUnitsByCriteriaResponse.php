<?php
namespace App\Domains\Condo\Boundary\Output;

use App\Domains\Shared\Boundary\Response;
use App\Domains\Condo\Boundary\DataStructure\UnitDS;

class FindUnitsByCriteriaResponse extends Response {
    public $unitsDS; // array de UnitDS
}