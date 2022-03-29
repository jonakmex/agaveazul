<?php 

namespace App\Http\Factory;

use App\Domains\Shared\UseCase\UseCaseFactory;
use App\Domains\Condo\UseCase\CreateUnitUseCase;
use App\Domains\Condo\UseCase\EditUnitUseCase;
use App\Domains\Condo\UseCase\FindUnitByIdUseCase;
use App\Domains\Condo\UseCase\FindUnitsByCriteriaUseCase;
use App\Domains\Condo\UseCase\DeleteUnitUseCase;
use App\Domains\Condo\Repository\UnitRepository;

class UseCaseFactoryContainer implements UseCaseFactory{

    public function make($useCaseName , $dependencies = []){
        if("CreateUnitUseCase" === $useCaseName)
            return $this->makeCreateUnitUseCase();
        if("FindUnitByIdUseCase" === $useCaseName)
            return $this->makeFindUnitByIdUseCase();
        if("EditUnitUseCase" === $useCaseName)
            return $this->makeEditUnitUseCase();
        if("FindUnitsByCriteriaUseCase" === $useCaseName)
            return $this->makeFindUnitsByCriteriaUseCase();
        if("DeleteUnitUseCase" === $useCaseName)
            return $this->makeDeleteUnitUseCase();
    }

    private function makeCreateUnitUseCase(){
        return new CreateUnitUseCase(app(UnitRepository::class));
    }

    private static function makeFindUnitByIdUseCase(){
        return new FindUnitByIdUseCase(app(UnitRepository::class));
    }

    private static function makeEditUnitUseCase(){
        return new EditUnitUseCase(app(UnitRepository::class));
    }

    private static function makeFindUnitsByCriteriaUseCase(){
        return new FindUnitsByCriteriaUseCase(app(UnitRepository::class));
    }

    private static function makeDeleteUnitUseCase(){
        return new DeleteUnitUseCase(app(UnitRepository::class));
    }
}