<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Navigation extends Component
{
    public $totalPages;
    public $prevPage;
    public $nextPage;
    public $pageNumber;

    public function __construct($totalPages, $prevPage, $nextPage, $pageNumber)
    {
        $this->totalPages = $totalPages;
        $this->prevPage = $prevPage;
        $this->nextPage = $nextPage;
        $this->pageNumber = $pageNumber;
    }

    public function render()
    {
        return view('components.navigation');
    }
}
