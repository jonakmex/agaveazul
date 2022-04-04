<?php

namespace Tests\Feature\Condo;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use Tests\Feature\Shared\Factory\RequestFactoryMock;
use Tests\Feature\Shared\Factory\UseCaseFactoryMock;
use Tests\Feature\Condo\Repository\ContactRepositoryMock;

class FindContactsByCriteriaTest extends TestCase
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
        $findContactByCriteriaRequest = $this->requestFactory->make("App\Domains\Condo\Boundary\Input\FindContactsByCriteriaRequest",["name"=>"Jorge", "lastName"=>"Sosa", "unit_id"=>2 , "type"=>"PROPIETARIO"]);
        $this->assertTrue(is_a($findContactByCriteriaRequest,"App\Domains\Condo\Boundary\Input\FindContactsByCriteriaRequest"));
    }

    public function test_should_list_all_contact(){
        $findContactsByCriteriaRequest = $this->requestFactory->make("App\Domains\Condo\Boundary\Input\FindContactsByCriteriaRequest",["name"=>"Jorge", "lastName"=>"Sosa", "type"=>"PROPIETARIO", "unit_id"=>2 ]);
        $dependecies = ["contactRepository" => new ContactRepositoryMock];
        $useCase = $this->useCaseFactory->make("FindContactsByCriteriaUseCase", $dependecies);
        $useCase->execute($findContactsByCriteriaRequest, function($response){
          $this->assertNotEmpty($response->contactsDS);
        });
      }
      public function test_should_be_empty_response()
      {
        $findContactsByCriteriaRequest = $this->requestFactory->make("App\Domains\Condo\Boundary\Input\FindContactsByCriteriaRequest",["name"=>"noexiste" , "lastName"=>"Sosa", "type"=>"PROPIETARIO", "unit_id"=>2 ]);
        $dependecies = ["contactRepository" => new ContactRepositoryMock];
        $useCase = $this->useCaseFactory->make("FindContactsByCriteriaUseCase", $dependecies);
        $useCase->execute($findContactsByCriteriaRequest, function($response){
          $this->assertEmpty($response->contactsDS);
        });
      }
}