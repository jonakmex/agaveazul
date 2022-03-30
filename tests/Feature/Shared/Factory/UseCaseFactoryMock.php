<?php
namespace Tests\Feature\Shared\Factory;

use App\Domains\Shared\UseCase\UseCaseFactory;
use App\Domains\Condo\UseCase\CreateUnitUseCase;
use App\Domains\Condo\UseCase\EditUnitUseCase;
use App\Domains\Condo\UseCase\FindUnitByIdUseCase;
use App\Domains\Condo\UseCase\FindUnitsByCriteriaUseCase;
use App\Domains\Condo\UseCase\DeleteUnitUseCase;


class UseCaseFactoryMock implements UseCaseFactory {

    public function make($useCaseName,$dependencies = []){
        if("CreateUnitUseCase" === $useCaseName)
            return $this->makeCreateUnitUseCase($dependencies);
        if("FindUnitByIdUseCase" === $useCaseName)
            return $this->makeFindUnitByIdUseCase($dependencies);
        if("EditUnitUseCase" === $useCaseName)
            return $this->makeEditUnitUseCase($dependencies);
        if("FindUnitsByCriteriaUseCase" === $useCaseName)
            return $this->makeFindUnitsByCriteriaUseCase($dependencies);
        if("DeleteUnitUseCase" === $useCaseName)
            return $this->makeDeleteUnitUseCase($dependencies);
    }

    private function makeCreateUnitUseCase($dependencies){
        return new CreateUnitUseCase($dependencies["unitRepository"]);
    }

    private static function makeFindUnitByIdUseCase($dependencies){
        return new FindUnitByIdUseCase($dependencies["unitRepository"]);
    }

    private static function makeEditUnitUseCase($dependencies){
        return new EditUnitUseCase($dependencies["unitRepository"]);
    }

    private static function makeFindUnitsByCriteriaUseCase($dependencies){
        return new FindUnitsByCriteriaUseCase($dependencies["unitRepository"]);
    }

    private static function makeDeleteUnitUseCase($dependencies){
        return new DeleteUnitUseCase($dependencies["unitRepository"]);
    }
}