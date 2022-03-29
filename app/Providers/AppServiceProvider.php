<?php

namespace App\Providers;

use App\Domains\Condo\Repository\UnitEloquentRepository;
use App\Domains\Condo\Repository\UnitRepository;
use Illuminate\Support\ServiceProvider;
use App\Domains\Shared\UseCase\UseCaseFactory;
use App\Http\Factory\UseCaseFactoryContainer;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(UseCaseFactory::class, function() {
            return new UseCaseFactoryContainer;
        });

        $this->app->singleton(UnitRepository::class, function() {
            return new UnitEloquentRepository;
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
