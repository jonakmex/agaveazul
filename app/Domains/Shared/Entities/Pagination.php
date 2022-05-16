<?php
namespace App\Domains\Shared\Entities;

class Pagination {
    public $numRecordsPerPage;
    public $pageNumber;

    public function getNumRecordsPerPage(){
        return $this->numRecordsPerPage;
    }
    public function setNumRecordsPerPage($numRecordsPerPage){
        $this->numRecordsPerPage = $numRecordsPerPage;
    }
    
    public function getPageNumber(){
        return $this->getPageNumber;
    }
    public function setPageNumber($getPageNumber){
        $this->getPageNumber = $getPageNumber;
    }
}