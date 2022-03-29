<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Domains\Shared\Boundary\RequestFactory;
use App\Domains\Shared\UseCase\UseCaseFactory;
use Tests\Feature\Condo\Repository\UnitRepositoryMock;

class DeleteUnitTest extends TestCase{
  public function test_should_create_request_object(){
    $deleteUnitRequest = RequestFactory::make("DeleteUnitRequest", ["id" => 1]);
    $this->assertTrue(
      is_a($deleteUnitRequest, "App\Domains\Condo\Boundary\Input\DeleteUnitRequest")
    );
  }
  
  public function test_should_delete_unit(){
    $deleteUnitRequest = RequestFactory::make("DeleteUnitRequest", ["id" => 1]);
    $dependencies = ["unitRepository" => new UnitRepositoryMock];
    $useCase = UseCaseFactory::make("DeleteUnitUseCase", $dependencies);
    $useCase->execute($deleteUnitRequest, function($response){
      $this->assertNotEmpty($response->unitDS);
    });
  }
}