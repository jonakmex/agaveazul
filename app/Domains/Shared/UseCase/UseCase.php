<?php

namespace App\Domains\Shared\UseCase;
use App\Domains\Shared\Boundary\Request;

interface UseCase {
    public function execute(Request $request,$callback);
}