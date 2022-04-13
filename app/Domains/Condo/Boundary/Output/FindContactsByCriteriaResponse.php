<?php
namespace App\Domains\Condo\Boundary\Output;

use App\Domains\Shared\Boundary\Response;
use App\Domains\Condo\Boundary\DataStructure\ContactDS;

class FindContactsByCriteriaResponse extends Response {
    public ContactDS $contactDS;
}