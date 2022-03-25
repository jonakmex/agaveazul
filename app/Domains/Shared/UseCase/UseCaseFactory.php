<?php
namespace App\Domains\Shared\UseCase;


use App\Domains\Condo\UseCase\CreateUnitUseCase;
use App\Domains\Condo\UseCase\EditUnitUseCase;
use App\Domains\Condo\UseCase\FindUnitByIdUseCase;


class UseCaseFactory {
    public static function make($useCaseName,$dependencies){
        if("CreateUnitUseCase" === $useCaseName)
            return UseCaseFactory::makeCreateUnitUseCase($dependencies);
        if("FindUnitByIdUseCase" === $useCaseName)
            return UseCaseFactory::makeFindUnitByIdUseCase($dependencies);
        if("EditUnitUseCase" === $useCaseName)
            return UseCaseFActory::makeEditUnitUseCase($dependencies);
        }

    private static function makeCreateUnitUseCase($dependencies){
        return new CreateUnitUseCase($dependencies["unitRepository"]);
    }

    private static function makeFindUnitByIdUseCase($dependencies){
        return new FindUnitByIdUseCase($dependencies["unitRepository"]);
    }

    private static function makeEditUnitUseCase($dependencies){
        return new EditUnitUseCase($dependencies["unitRepository"]);
    }
}