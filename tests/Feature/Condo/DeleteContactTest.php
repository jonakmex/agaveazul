<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use Tests\Feature\Shared\Factory\RequestFactoryMock;
use Tests\Feature\Shared\Factory\UseCaseFactoryMock;
use Tests\Feature\Condo\Repository\ContactRepositoryMock;

class DeleteContactTest extends TestCase
{
    private $useCaseFactory;
    private $requestFactory;

    public function setUp() :void{
        parent::setUp();
        $this->useCaseFactory = new UseCaseFactoryMock;
        $this->requestFactory = new RequestFactoryMock;
    }


    public function test_should_delete_contact(){
        $DeleteContactRequest = $this->requestFactory->make("App\Domains\Condo\Boundary\Input\DeleteContactRequest",["name"=>"Jorge", "lastName"=>"Sosa", "type"=>"PROPIETARIO", "id"=> 3 ,"unit_id"=> 1]);
        $dependencies = ["contactRepository" => new ContactRepositoryMock];
        $useCase = $this->useCaseFactory->make("DeleteContactUseCase", $dependencies);
        $useCase->execute($DeleteContactRequest, function($response){
          $this->assertNotEmpty($response->contactDS);
        });
      }

    
    
}