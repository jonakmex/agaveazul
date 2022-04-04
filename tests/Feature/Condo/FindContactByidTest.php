<?php

namespace Tests\Feature\Condo;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use Tests\Feature\Shared\Factory\RequestFactoryMock;
use Tests\Feature\Shared\Factory\UseCaseFactoryMock;
use Tests\Feature\Condo\Repository\ContactRepositoryMock;

class FindContactByIdTest extends TestCase
{
    private $useCaseFactory;
    private $requestFactory;

    public function setUp() :void{
        parent::setUp();
        $this->useCaseFactory = new UseCaseFactoryMock;
        $this->requestFactory = new RequestFactoryMock;
    }

    public function test_should_create_request_object()
    {
        $findContactByIdRequest = $this->requestFactory->make("App\Domains\Condo\Boundary\Input\FindContactByIdRequest",["name"=>"Jorge", "lastName"=>"Sosa", "type"=>"PROPIETARIO" , "unit_id"=>2, "id"=>2]);
        $this->assertTrue(is_a($findContactByIdRequest,"App\Domains\Condo\Boundary\Input\FindContactByIdRequest"));
    }

    public function test_should_create_request_object_with_id()
    {
        $findContactByIdRequest = $this->requestFactory->make("App\Domains\Condo\Boundary\Input\FindContactByIdRequest",["name"=>"Jorge", "lastName"=>"Sosa", "type"=>"PROPIETARIO" , "unit_id"=>2, "id"=>2]);
        $this->assertEquals($findContactByIdRequest->id,2);
    }

    public function test_should_find_contact_given_id(){
        $findContactByIdRequest = $this->requestFactory->make("App\Domains\Condo\Boundary\Input\FindContactByIdRequest",["id"=>2]);
        $dependencies = ["contactRepository"=>new ContactRepositoryMock];
        $useCaseFactory = new UseCaseFactoryMock;
        $useCase = $this->useCaseFactory->make("FindContactByIdUseCase",$dependencies);
        $useCase->execute($findContactByIdRequest,function($response){
            $this->assertNotEmpty($response->contactDS->name);
            $this->assertEquals($response->contactDS->id, 2);
        });
    }
    public function test_should_show_must_be_positive(){
        $findContactByIdRequest = $this->requestFactory->make("App\Domains\Condo\Boundary\Input\FindContactByIdRequest",["id"=>-2]);
        $dependencies = ["contactRepository"=>new ContactRepositoryMock];
        $useCaseFactory = new UseCaseFactoryMock;
        $useCase = $this->useCaseFactory->make("FindContactByIdUseCase",$dependencies);
        $useCase->execute($findContactByIdRequest,function($response){
            $this->assertEquals($response->errors[0]["id"],"MSG_ERR_MUST_BE_POSITIVE");
        });
    }
}
