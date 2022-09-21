<?php

namespace App\Domains\Shared\Entities;

class Pagination
{
    public $perPage;
    public $pageNumber;

    public function __construct($perPage, $pageNumber)
    {
        $this->perPage = $perPage;
        $this->pageNumber = $pageNumber;
    }

    public function getPerPage()
    {
        return $this->perPage;
    }

    public function setPerPage($perPage)
    {
        $this->perPage = $perPage;
    }

    public function getPageNumber()
    {
        return $this->pageNumber;
    }

    public function setPageNumber($pageNumber)
    {
        $this->pageNumber = $pageNumber;
    }
}