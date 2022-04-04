<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use Tests\Feature\Shared\Factory\RequestFactoryMock;
use Tests\Feature\Shared\Factory\UseCaseFactoryMock;
use Tests\Feature\Condo\Repository\ContactRepositoryMock;

class CreateContactTest extends TestCase
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
        $createContactRequest = $this->requestFactory->make("App\Domains\Condo\Boundary\Input\CreateContactRequest",["name"=>"Jorge", "lastName"=>"Sosa", "type"=>"PROPIETARIO" , "unit_id"=>2]);
        $this->assertTrue(is_a($createContactRequest,"App\Domains\Condo\Boundary\Input\CreateContactRequest"));
    }

    public function test_should_create_object_with_name(){
        $createContactRequest = $this->requestFactory->make("App\Domains\Condo\Boundary\Input\CreateContactRequest",["name"=>"Jorge", "lastName"=>"Sosa", "type"=>"PROPIETARIO" , "unit_id"=>2]);
        $this->assertEquals($createContactRequest->name,"Jorge");
    }

    public function test_should_create_contact(){
        $createContactRequest = $this->requestFactory->make("App\Domains\Condo\Boundary\Input\CreateContactRequest",["name"=>"Jorge", "lastName"=>"Sosa", "type"=>"PROPIETARIO" , "unit_id"=>2]);
        $dependencies = ["contactRepository"=>new ContactRepositoryMock];
        $useCase = $this->useCaseFactory->make("CreateContactUseCase",$dependencies);
        $useCase->execute($createContactRequest,function($response){
            $this->assertNotEmpty($response->contactDS->id);
        });
    }


    
}