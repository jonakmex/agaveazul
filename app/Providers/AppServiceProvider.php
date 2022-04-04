<?php

namespace App\Providers;
use Illuminate\Support\ServiceProvider;

use App\Domains\Condo\Repository\AssetEloquentRepository;
use App\Domains\Condo\Repository\AssetRepository;
use App\Domains\Condo\Repository\UnitEloquentRepository;
use App\Domains\Condo\Repository\UnitRepository;
use App\Domains\Shared\UseCase\UseCaseFactory;
use App\Domains\Shared\Boundary\RequestFactory;
use App\Http\Factory\UseCaseFactoryContainer;
use App\Http\Factory\RequestFactoryReflective;

use App\Domains\Condo\UseCase\CreateUnitUseCase;
use App\Domains\Condo\UseCase\EditUnitUseCase;
use App\Domains\Condo\UseCase\FindUnitByIdUseCase;
use App\Domains\Condo\UseCase\FindUnitsByCriteriaUseCase;
use App\Domains\Condo\UseCase\DeleteUnitUseCase;

use App\Domains\Condo\UseCase\CreateAssetUseCase;
use App\Domains\Condo\UseCase\EditAssetUseCase;
use App\Domains\Condo\UseCase\FindAssetByIdUseCase;
use App\Domains\Condo\UseCase\FindAssetsByCriteriaUseCase;
use App\Domains\Condo\UseCase\DeleteAssetUseCase;

use App\Domains\Condo\Repository\ContactEloquentRepository;
use App\Domains\Condo\Repository\ContactRepository;

use App\Domains\Condo\UseCase\CreateContactUseCase;
use App\Domains\Condo\UseCase\EditContactUseCase;
use App\Domains\Condo\UseCase\FindContactByIdUseCase;
use App\Domains\Condo\UseCase\FindContactsByCriteriaUseCase;
use App\Domains\Condo\UseCase\DeleteContactUseCase;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //Factories
        $this->app->singleton(UseCaseFactory::class, function() {
            return new UseCaseFactoryContainer;
        });

        $this->app->singleton(RequestFactory::class, function() {
            return new RequestFactoryReflective;
        });

        // Repository
        $this->app->singleton(UnitRepository::class, function() {
            return new UnitEloquentRepository;
        });

        $this->app->singleton(AssetRepository::class, function() {
            return new AssetEloquentRepository;
        });
        
        $this->app->singleton(ContactRepository::class, function() {
            return new ContactEloquentRepository;
        });

        // Use Cases
        $this->app->singleton(CreateUnitUseCase::class, function() {
            return new CreateUnitUseCase(app(UnitRepository::class));
        });

        $this->app->singleton(FindUnitByIdUseCase::class, function() {
            return new FindUnitByIdUseCase(app(UnitRepository::class));
        });

        $this->app->singleton(EditUnitUseCase::class, function() {
            return new EditUnitUseCase(app(UnitRepository::class));
        });

        $this->app->singleton(FindUnitsByCriteriaUseCase::class, function() {
            return new FindUnitsByCriteriaUseCase(app(UnitRepository::class));
        });

        $this->app->singleton(DeleteUnitUseCase::class, function() {
            return new DeleteUnitUseCase(app(UnitRepository::class));
        });
        // asset use cases
        $this->app->singleton(CreateAssetUseCase::class, function() {
            return new CreateAssetUseCase(app(AssetRepository::class));
        });

        $this->app->singleton(FindAssetByIdUseCase::class, function() {
            return new FindAssetByIdUseCase(app(AssetRepository::class));
        });

        $this->app->singleton(EditAssetUseCase::class, function() {
            return new EditAssetUseCase(app(AssetRepository::class));
        });

        $this->app->singleton(FindAssetsByCriteriaUseCase::class, function() {
            return new FindAssetsByCriteriaUseCase(app(AssetRepository::class));
        });

        $this->app->singleton(DeleteAssetUseCase::class, function() {
            return new DeleteAssetUseCase(app(AssetRepository::class));
        });
        



        $this->app->singleton(CreateContactUseCase::class, function() {
            return new CreateContactUseCase(app(ContactRepository::class));
        });

        $this->app->singleton(EditContactUseCase::class, function() {
            return new EditContactUseCase(app(ContactRepository::class));
        });

        $this->app->singleton(FindContactByIdUseCase::class, function() {
            return new FindContactByIdUseCase(app(ContactRepository::class));
        });

        $this->app->singleton(FindContactsByCriteriaUseCase::class, function() {
            return new FindContactsByCriteriaUseCase(app(ContactRepository::class));
        });

        $this->app->singleton(DeleteContactUseCase::class, function() {
            return new DeleteContactUseCase(app(ContactRepository::class));
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
