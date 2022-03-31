<?php

namespace Tests\Feature;


use Tests\TestCase;

use Tests\Feature\Shared\Factory\RequestFactoryMock;
use Tests\Feature\Shared\Factory\UseCaseFactoryMock;
use Tests\Feature\Condo\Repository\UnitRepositoryMock;

class DeleteUnitTest extends TestCase{
  
  private $useCaseFactory;
  private $requestFactory;

    public function setUp() :void{
        parent::setUp();
        $this->useCaseFactory = new UseCaseFactoryMock;
        $this->requestFactory = new RequestFactoryMock;
    }

  public function test_should_create_request_object(){
    $deleteUnitRequest = $this->requestFactory->make("App\Domains\Condo\Boundary\Input\DeleteUnitRequest", ["id" => 1]);
    $this->assertTrue(
      is_a($deleteUnitRequest, "App\Domains\Condo\Boundary\Input\DeleteUnitRequest")
    );
  }
  
  public function test_should_delete_unit(){
    $deleteUnitRequest = $this->requestFactory->make("App\Domains\Condo\Boundary\Input\DeleteUnitRequest", ["id" => 1]);
    $dependencies = ["unitRepository" => new UnitRepositoryMock];
    $useCase = $this->useCaseFactory->make("DeleteUnitUseCase", $dependencies);
    $useCase->execute($deleteUnitRequest, function($response){
      $this->assertNotEmpty($response->unitDS);
    });
  }
}