<?php

namespace App\Domains\Condo\Boundary\Input;

use App\Domains\Shared\Boundary\Request;
use App\Domains\Shared\Boundary\DS\PaginationDS;
use App\Domains\Shared\Boundary\DS\OrderDS;

class FindUnitsByCriteriaRequest extends Request
{
    public $description;
    public ?PaginationDS $pagination;
    public ?OrderDS $order;

    public function __construct()
    {
        $this->pagination = null;
        $this->order = null;
    }

    public function validate()
    {
        $errors = [];

        if (strlen($this->description) > 100)
            $errors[] = ["description" => "MSG_ERR_TOO_LARGE"];

        return $errors;
    }
}