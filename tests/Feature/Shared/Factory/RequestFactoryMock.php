<?php
namespace Tests\Feature\Shared\Factory;

use App\Domains\Shared\Boundary\RequestFactory;


class RequestFactoryMock implements RequestFactory {
    
    public function make($requestName,$params) {
        $request = new $requestName();
        foreach ( get_object_vars($request) as $var => $val){
            if(array_key_exists( $var, $params ))
                $request->{$var} = $params[$var];
        }
        return $request;
    }
}