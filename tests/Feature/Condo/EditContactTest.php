<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use Tests\Feature\Shared\Factory\RequestFactoryMock;
use Tests\Feature\Shared\Factory\UseCaseFactoryMock;
use Tests\Feature\Condo\Repository\ContactRepositoryMock;

class EditContactTest extends TestCase
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
        $EditContactRequest = $this->requestFactory->make("App\Domains\Condo\Boundary\Input\EditContactRequest",["name"=>"Jorge", "lastName"=>"Sosa", "type"=>"PROPIETARIO", "id"=> 3, "unit_id"=>2]);
        $this->assertTrue(is_a($EditContactRequest,"App\Domains\Condo\Boundary\Input\EditContactRequest"));
        $this->assertEquals($EditContactRequest->name,"Jorge");
        $this->assertEquals($EditContactRequest->lastName, "Sosa");
        $this->assertEquals($EditContactRequest->type, "PROPIETARIO");
        $this->assertEquals($EditContactRequest->id, 3);
    }

    public function test_should_edit_contact(){
        $EditContactRequest = $this->requestFactory->make("App\Domains\Condo\Boundary\Input\EditContactRequest",["name"=>"Jorge", "lastName"=>"Sosa", "type"=>"PROPIETARIO", "id"=> 3, "unit_id"=>2]);
        $dependencies = ["contactRepository"=>new ContactRepositoryMock];
        $useCase = $this->useCaseFactory->make("EditContactUseCase",$dependencies); 
        $useCase->execute($EditContactRequest,function($response){
          $this->assertEquals($response->contactDS->id,"3");
        });
        
    }

    
}