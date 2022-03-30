<?php 

namespace App\Http\Factory;

use App\Domains\Shared\UseCase\UseCaseFactory;

class UseCaseFactoryContainer implements UseCaseFactory{

    public function make($useCaseName , $dependencies = []){
        return app($useCaseName);
    }

}