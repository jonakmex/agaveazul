<?php
namespace App\Domains\Shared\Boundary;

use App\Domains\Condo\Boundary\Input\CreateUnitRequest;

class RequestFactory {
    public static function make($request,$params){
        if("CreateUnitRequest" === $request)
            return RequestFactory::makeCreateUnitRequest($params);
    }

    private static function makeCreateUnitRequest($params){
        $obj = new CreateUnitRequest;
        $obj->description = $params["description"];
        return $obj;
    }
}