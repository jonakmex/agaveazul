<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Domains\Shared\Boundary\RequestFactory;
use App\Domains\Shared\UseCase\UseCaseFactory;
use Tests\Feature\Condo\Repository\UnitRepositoryMock;

class CreateUnitTest extends TestCase
{

    public function test_should_create_request_object()
    {
        $createUnitRequest = RequestFactory::make("CreateUnitRequest",["description"=>"Test 1"]);
        $this->assertTrue(is_a($createUnitRequest,"App\Domains\Condo\Boundary\Input\CreateUnitRequest"));
    }

    public function test_should_create_request_object_with_description()
    {
        $createUnitRequest = RequestFactory::make("CreateUnitRequest",["description"=>"Test 1"]);
        $this->assertEquals($createUnitRequest->description,"Test 1");
    }

    public function test_should_create_unit(){
        $createUnitRequest = RequestFactory::make("CreateUnitRequest",["description"=>"Test 1"]);
        $dependencies = ["unitRepository"=>new UnitRepositoryMock];
        $useCase = UseCaseFactory::make("CreateUnitUseCase",$dependencies);
        $useCase->execute($createUnitRequest,function($response){
            $this->assertNotEmpty($response->unitDS->id);
        });
        
    }

    public function test_should_show_too_short(){
        $createUnitRequest = RequestFactory::make("CreateUnitRequest",["description"=>""]);
        $dependencies = ["unitRepository"=>new UnitRepositoryMock];
        $useCase = UseCaseFactory::make("CreateUnitUseCase",$dependencies);
        $useCase->execute($createUnitRequest,function($response){
            $this->assertEquals($response->errors[0]["description"],"MSG_ERR_TOO_SHORT");
        });
    }

    public function test_should_show_too_large(){
        $createUnitRequest = RequestFactory::make("CreateUnitRequest",["description"=>"012345677898282"]);
        
        $dependencies = ["unitRepository"=>new UnitRepositoryMock];
        $useCase = UseCaseFactory::make("CreateUnitUseCase",$dependencies);
        $useCase->execute($createUnitRequest,function($response){
            $this->assertEquals($response->errors[0]["description"],"MSG_ERR_TOO_LARGE");
        });
    }
}
