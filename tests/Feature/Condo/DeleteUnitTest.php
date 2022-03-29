<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Domains\Shared\Boundary\RequestFactory;
use Tests\Feature\Shared\Factory\UseCaseFactoryMock;
use Tests\Feature\Condo\Repository\UnitRepositoryMock;

class DeleteUnitTest extends TestCase{
  
  private $useCaseFactory;

    public function setUp() :void{
        parent::setUp();
        $this->useCaseFactory = new UseCaseFactoryMock;
    }

  public function test_should_create_request_object(){
    $deleteUnitRequest = RequestFactory::make("DeleteUnitRequest", ["id" => 1]);
    $this->assertTrue(
      is_a($deleteUnitRequest, "App\Domains\Condo\Boundary\Input\DeleteUnitRequest")
    );
  }
  
  public function test_should_delete_unit(){
    $deleteUnitRequest = RequestFactory::make("DeleteUnitRequest", ["id" => 1]);
    $dependencies = ["unitRepository" => new UnitRepositoryMock];
    $useCase = $this->useCaseFactory->make("DeleteUnitUseCase", $dependencies);
    $useCase->execute($deleteUnitRequest, function($response){
      $this->assertNotEmpty($response->unitDS);
    });
  }
}