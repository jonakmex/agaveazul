<?php

namespace Tests\Feature\Condo;

use Tests\TestCase;

use Tests\Feature\Shared\Factory\RequestFactoryMock;
use Tests\Feature\Shared\Factory\UseCaseFactoryMock;
use Tests\Feature\Condo\Repository\UnitRepositoryMock;

class FindUnitByIdTest extends TestCase
{
    private $useCaseFactory;
    private $requestFactory;

    public function setUp() :void{
        parent::setUp();
        $this->useCaseFactory = new UseCaseFactoryMock;
        $this->requestFactory = new RequestFactoryMock;
    }

    public function test_should_create_request_object(){
        $findUnitByIdRequest = $this->requestFactory->make("App\Domains\Condo\Boundary\Input\FindUnitByIdRequest",["id"=>1]);
        $this->assertTrue(
            is_a($findUnitByIdRequest,"App\Domains\Condo\Boundary\Input\FindUnitByIdRequest")
        );
    }

    public function test_should_create_request_object_with_id()
    {
        $findUnitByIdRequest = $this->requestFactory->make("App\Domains\Condo\Boundary\Input\FindUnitByIdRequest",["id"=>15]);
        $this->assertEquals($findUnitByIdRequest->id,15);
    }

    public function test_should_find_unit_given_id(){
        $findUnitByIdRequest = $this->requestFactory->make("App\Domains\Condo\Boundary\Input\FindUnitByIdRequest",["id"=>15]);
        $dependencies = ["unitRepository"=>new UnitRepositoryMock];
        $useCaseFactory = new UseCaseFactoryMock;
        $useCase = $this->useCaseFactory->make("FindUnitByIdUseCase",$dependencies);
        $useCase->execute($findUnitByIdRequest,function($response){
            $this->assertNotEmpty($response->unitDS->description);
            $this->assertEquals($response->unitDS->id, 15);
        });
    }

    public function test_should_show_must_be_positive(){
        $findUnitByIdRequest = $this->requestFactory->make("App\Domains\Condo\Boundary\Input\FindUnitByIdRequest",["id"=>-1]);
        $dependencies = ["unitRepository"=>new UnitRepositoryMock];
        $useCaseFactory = new UseCaseFactoryMock;
        $useCase = $this->useCaseFactory->make("FindUnitByIdUseCase",$dependencies);
        $useCase->execute($findUnitByIdRequest,function($response){
            $this->assertEquals($response->errors[0]["id"],"MSG_ERR_MUST_BE_POSITIVE");
        });
    }
}
