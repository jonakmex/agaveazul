<?php

namespace Tests\Feature;

use Tests\TestCase;
use Tests\Feature\Shared\Factory\RequestFactoryMock;
use Tests\Feature\Shared\Factory\UseCaseFactoryMock;
use Tests\Feature\Condo\Repository\UnitRepositoryMock;

class CreateUnitTest extends TestCase
{
    private $useCaseFactory;
    private $requestFactory;

    public function setUp() : void {
        parent::setUp();
        $this->useCaseFactory = new UseCaseFactoryMock;
        $this->requestFactory = new RequestFactoryMock;
    }


    public function test_should_create_request_object()
    {
        $createUnitRequest = $this->requestFactory->make("App\Domains\Condo\Boundary\Input\CreateUnitRequest",["description"=>"Test 1"]);
        $this->assertTrue(is_a($createUnitRequest,"App\Domains\Condo\Boundary\Input\CreateUnitRequest"));
    }

    public function test_should_create_request_object_with_description()
    {
        $createUnitRequest = $this->requestFactory->make("App\Domains\Condo\Boundary\Input\CreateUnitRequest",["description"=>"Test 1"]);
        $this->assertEquals($createUnitRequest->description,"Test 1");
    }

    public function test_should_create_unit(){
        $createUnitRequest = $this->requestFactory->make("App\Domains\Condo\Boundary\Input\CreateUnitRequest",["description"=>"Test 1"]);
        $dependencies = ["unitRepository"=>new UnitRepositoryMock];
        $useCase = $this->useCaseFactory->make("CreateUnitUseCase",$dependencies);
        $useCase->execute($createUnitRequest,function($response){
            $this->assertNotEmpty($response->unitDS->id);
        });
        
    }

    public function test_should_show_too_short(){
        $createUnitRequest = $this->requestFactory->make("App\Domains\Condo\Boundary\Input\CreateUnitRequest",["description"=>""]);
        $dependencies = ["unitRepository"=>new UnitRepositoryMock];
        $useCase = $this->useCaseFactory->make("CreateUnitUseCase",$dependencies);
        $useCase->execute($createUnitRequest,function($response){
            $this->assertEquals($response->errors[0]["description"],"MSG_ERR_TOO_SHORT");
        });
    }

    public function test_should_show_too_large(){
        $createUnitRequest = $this->requestFactory->make("App\Domains\Condo\Boundary\Input\CreateUnitRequest",["description"=>"012345677898282"]);
        
        $dependencies = ["unitRepository"=>new UnitRepositoryMock];
        $useCase = $this->useCaseFactory->make("CreateUnitUseCase",$dependencies);
        $useCase->execute($createUnitRequest,function($response){
            $this->assertEquals($response->errors[0]["description"],"MSG_ERR_TOO_LARGE");
        });
    }
}
