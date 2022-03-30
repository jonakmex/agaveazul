<?php
namespace App\Domains\Shared\UseCase;

interface UseCaseFactory {
    public function make($useCaseName,$dependencies = []);
}