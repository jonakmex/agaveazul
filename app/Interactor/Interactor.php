<?php
namespace App\Interactor;

use App\DS\Request;

interface Interactor{
    public function execute(Request $request);
}