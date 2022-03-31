<?php

namespace App\Providers;
use Illuminate\Support\ServiceProvider;

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
