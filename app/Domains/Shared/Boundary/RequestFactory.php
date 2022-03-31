<?php
namespace App\Domains\Shared\Boundary;

interface RequestFactory {
    public function make($requestName,$params);
}