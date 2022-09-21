<?php

namespace Tests\Feature\Shared\Factory;

use App\Domains\Shared\UseCase\UseCaseFactory;
use App\Domains\Condo\UseCase\CreateUnitUseCase;
use App\Domains\Condo\UseCase\EditUnitUseCase;
use App\Domains\Condo\UseCase\FindUnitByIdUseCase;
use App\Domains\Condo\UseCase\FindUnitsByCriteriaUseCase;
use App\Domains\Condo\UseCase\DeleteUnitUseCase;
use App\Domains\Condo\UseCase\CreateContactUseCase;
use App\Domains\Condo\UseCase\EditContactUseCase;
use App\Domains\Condo\UseCase\DeleteContactUseCase;
use App\Domains\Condo\UseCase\FindContactByIdUseCase;
use App\Domains\Condo\UseCase\FindContactsByCriteriaUseCase;
use App\Domains\Condo\UseCase\CreateAssetUseCase;
use App\Domains\Condo\UseCase\EditAssetUseCase;
use App\Domains\Condo\UseCase\FindAssetByIdUseCase;
use App\Domains\Condo\UseCase\FindAssetsByCriteriaUseCase;
use App\Domains\Condo\UseCase\DeleteAssetUseCase;

class UseCaseFactoryMock implements UseCaseFactory
{

    public function make($useCaseName, $dependencies = [])
    {
        if (!method_exists(self::class, "make$useCaseName"))
            return null;

        return $this->{"make$useCaseName"}($dependencies);
        //For static methods:
        //return call_user_func([self::class, "make$useCaseName"], $dependencies);
    }

    private function makeCreateUnitUseCase($dependencies)
    {
        return new CreateUnitUseCase($dependencies["unitRepository"]);
    }

    private static function makeFindUnitByIdUseCase($dependencies)
    {
        return new FindUnitByIdUseCase($dependencies["unitRepository"]);
    }

    private static function makeEditUnitUseCase($dependencies)
    {
        return new EditUnitUseCase($dependencies["unitRepository"]);
    }

    private static function makeFindUnitsByCriteriaUseCase($dependencies)
    {
        return new FindUnitsByCriteriaUseCase($dependencies["unitRepository"]);
    }

    private static function makeDeleteUnitUseCase($dependencies)
    {
        return new DeleteUnitUseCase($dependencies["unitRepository"]);
    }

    private function makeCreateAssetUseCase($dependencies)
    {
        return new CreateAssetUseCase($dependencies["assetRepository"]);
    }

    private function makeFindAssetByIdUseCase($dependencies)
    {
        return new FindAssetByIdUseCase($dependencies["assetRepository"]);
    }

    private function makeEditAssetUseCase($dependencies)
    {
        return new EditAssetUseCase($dependencies["assetRepository"]);
    }

    private function makeFindAssetsByCriteriaUseCase($dependencies)
    {
        return new FindAssetsByCriteriaUseCase($dependencies["assetRepository"]);
    }

    private function makeDeleteAssetUseCase($dependencies)
    {
        return new DeleteAssetUseCase($dependencies["assetRepository"]);
    }

    private static function makeCreateContactUseCase($dependencies)
    {
        return new CreateContactUseCase($dependencies["contactRepository"]);
    }

    private static function makeEditContactUseCase($dependencies)
    {
        return new EditContactUseCase($dependencies["contactRepository"]);
    }

    private static function makeDeleteContactUseCase($dependencies)
    {
        return new DeleteContactUseCase($dependencies["contactRepository"]);
    }

    private static function makeFindContactByIdUseCase($dependencies)
    {
        return new FindContactByIdUseCase($dependencies["contactRepository"]);
    }

    private static function makeFindContactsByCriteriaUseCase($dependencies)
    {
        return new FindContactsByCriteriaUseCase($dependencies["contactRepository"]);
    }
}