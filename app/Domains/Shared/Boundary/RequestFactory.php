<?php
namespace App\Domains\Shared\Boundary;

use App\Domains\Condo\Boundary\Input\CreateUnitRequest;
use App\Domains\Condo\Boundary\Input\FindUnitByIdRequest;
use App\Domains\Condo\Boundary\Input\EditUnitRequest;

class RequestFactory {
    public static function make($requestName,$params){
        if("CreateUnitRequest" === $requestName)
            return RequestFactory::makeCreateUnitRequest($params);
        if("FindUnitByIdRequest" === $requestName)
            return RequestFactory::makeFindUnitByIdRequest($params);
        if("EditUnitRequest" === $requestName)
            return RequestFactory::makeEditUnitRequest($params);
    }

    private static function makeCreateUnitRequest($params){
        $obj = new CreateUnitRequest;
        $obj->description = $params["description"];
        return $obj;
    }
    
    private static function makeFindUnitByIdRequest($params){
        $obj = new FindUnitByIdRequest;
        $obj->id = $params["id"];
        return $obj;
    }


    private static function makeEditUnitRequest( $params){
        $obj = new EditUnitRequest;
        $obj->id = $params["id"];
        $obj->description = $params["description"];
        return $obj;
    }
}