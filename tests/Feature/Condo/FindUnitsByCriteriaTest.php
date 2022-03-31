<?php

namespace Tests\Feature;

use Tests\TestCase;

use Tests\Feature\Shared\Factory\RequestFactoryMock;
use Tests\Feature\Shared\Factory\UseCaseFactoryMock;
use Tests\Feature\Condo\Repository\UnitRepositoryMock;

class FindUnitsByCriteriaTest extends TestCase
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
        $findUnitsByCriteriaRequest = $this->requestFactory->make("App\Domains\Condo\Boundary\Input\FindUnitsByCriteriaRequest",["description"=>"test"]);
        $this->assertTrue(is_a($findUnitsByCriteriaRequest,"App\Domains\Condo\Boundary\Input\FindUnitsByCriteriaRequest"));
    }

    public function test_should_list_all_units(){
      $findUnitsByCriteriaRequest = $this->requestFactory->make("App\Domains\Condo\Boundary\Input\FindUnitsByCriteriaRequest",["description"=>"test"]);
      $dependecies = ["unitRepository" => new UnitRepositoryMock];
      $useCaseFactory = new UseCaseFactoryMock;
      $useCase = $this->useCaseFactory->make("FindUnitsByCriteriaUseCase", $dependecies);
      $useCase->execute($findUnitsByCriteriaRequest, function($response){
        $this->assertNotEmpty($response->unitsDS);
      });
    }
    
    public function test_should_list_all_units_given_desc(){
      $findUnitsByCriteriaRequest = $this->requestFactory->make("App\Domains\Condo\Boundary\Input\FindUnitsByCriteriaRequest",["description"=>"test"]);
      $dependecies = ["unitRepository" => new UnitRepositoryMock];
      $useCaseFactory = new UseCaseFactoryMock;
      $useCase = $this->useCaseFactory->make("FindUnitsByCriteriaUseCase", $dependecies);
      $useCase->execute($findUnitsByCriteriaRequest, function($response){
        //el mock crea exactamente 5 con la palabra "test"
        $this->assertCount(5, $response->unitsDS);
      });
    }

    public function test_for_each_response_element_be_unitds_object(){
      $findUnitsByCriteriaRequest = $this->requestFactory->make("App\Domains\Condo\Boundary\Input\FindUnitsByCriteriaRequest",["description"=>"test"]);
      $dependecies = ["unitRepository" => new UnitRepositoryMock];
      $useCaseFactory = new UseCaseFactoryMock;
      $useCase = $this->useCaseFactory->make("FindUnitsByCriteriaUseCase", $dependecies);
      $useCase->execute($findUnitsByCriteriaRequest, function($response){
        foreach($response->unitsDS as $unit){
          $this->assertTrue(
            is_a($unit, "App\Domains\Condo\Boundary\DataStructure\UnitDS")
          );
        }
      });
    }

    public function test_should_be_empty_response()
    {
      $findUnitsByCriteriaRequest = $this->requestFactory->make("App\Domains\Condo\Boundary\Input\FindUnitsByCriteriaRequest",["description"=>"noexiste"]);
      $dependecies = ["unitRepository" => new UnitRepositoryMock];
      $useCaseFactory = new UseCaseFactoryMock;
      $useCase = $this->useCaseFactory->make("FindUnitsByCriteriaUseCase", $dependecies);
      $useCase->execute($findUnitsByCriteriaRequest, function($response){
        $this->assertEmpty($response->unitsDS);
      });
    }
}
