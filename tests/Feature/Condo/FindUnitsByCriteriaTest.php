<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Domains\Shared\Boundary\RequestFactory;
use App\Domains\Shared\UseCase\UseCaseFactory;
use Tests\Feature\Condo\Repository\UnitRepositoryMock;

class FindUnitsByCriteriaTest extends TestCase
{

    public function test_should_create_request_object()
    {
        $findUnitsByCriteriaRequest = RequestFactory::make("FindUnitsByCriteriaRequest",["description"=>"test"]);
        $this->assertTrue(is_a($findUnitsByCriteriaRequest,"App\Domains\Condo\Boundary\Input\FindUnitsByCriteriaRequest"));
    }

    public function test_should_list_all_units(){
      $findUnitsByCriteriaRequest = RequestFactory::make("FindUnitsByCriteriaRequest",["description"=>"test"]);
      $dependecies = ["unitRepository" => new UnitRepositoryMock];
      $useCase = UseCaseFactory::make("FindUnitsByCriteriaUseCase", $dependecies);
      $useCase->execute($findUnitsByCriteriaRequest, function($response){
        $this->assertNotEmpty($response->unitsDS);
      });
    }
    
    public function test_should_list_all_units_given_desc(){
      $findUnitsByCriteriaRequest = RequestFactory::make("FindUnitsByCriteriaRequest",["description"=>"test"]);
      $dependecies = ["unitRepository" => new UnitRepositoryMock];
      $useCase = UseCaseFactory::make("FindUnitsByCriteriaUseCase", $dependecies);
      $useCase->execute($findUnitsByCriteriaRequest, function($response){
        //el mock crea exactamente 5 con la palabra "test"
        $this->assertCount(5, $response->unitsDS);
      });
    }

    public function test_for_each_response_element_be_unitds_object(){
      $findUnitsByCriteriaRequest = RequestFactory::make("FindUnitsByCriteriaRequest",["description"=>"test"]);
      $dependecies = ["unitRepository" => new UnitRepositoryMock];
      $useCase = UseCaseFactory::make("FindUnitsByCriteriaUseCase", $dependecies);
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
      $findUnitsByCriteriaRequest = RequestFactory::make("FindUnitsByCriteriaRequest",["description"=>"noexiste"]);
      $dependecies = ["unitRepository" => new UnitRepositoryMock];
      $useCase = UseCaseFactory::make("FindUnitsByCriteriaUseCase", $dependecies);
      $useCase->execute($findUnitsByCriteriaRequest, function($response){
        $this->assertEmpty($response->unitsDS);
      });
    }
}
