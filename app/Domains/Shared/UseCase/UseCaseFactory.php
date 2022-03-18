<?php
namespace App\Domains\Shared\UseCase;
use App\Domains\Condo\UseCase\CreateUnitUseCase;

class UseCaseFactory {
    public static function make($useCaseName,$dependencies){
        if("CreateUnitUseCase" === $useCaseName)
            return UseCaseFactory::makeCreateUnitUseCase($dependencies);
    }

    private static function makeCreateUnitUseCase($dependencies){
        return new CreateUnitUseCase($dependencies["unitRepository"]);
    }
}