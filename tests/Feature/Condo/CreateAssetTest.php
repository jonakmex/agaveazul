<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use Tests\Feature\Shared\Factory\RequestFactoryMock;
use Tests\Feature\Shared\Factory\UseCaseFactoryMock;
use Tests\Feature\Condo\Repository\AssetRepositoryMock;

class CreateAssetTest extends TestCase
{
    private $useCaseFactory;
    private $requestFactory;

    public function setUp() :void{
        parent::setUp();
        $this->useCaseFactory = new UseCaseFactoryMock;
        $this->requestFactory = new RequestFactoryMock;
    }

    public function test_should_create_request_object(){
        $createAssetRequest = $this->requestFactory->make("App\Domains\Condo\Boundary\Input\CreateAssetRequest",["unitId"=>1,"type"=>"AUTOMOVIL","description"=>"Mustang rojo"]);
        $this->assertTrue(is_a($createAssetRequest,"App\Domains\Condo\Boundary\Input\CreateAssetRequest"));
    }

    public function test_should_create_request_object_with_type(){
      $createAssetRequest = $this->requestFactory->make("App\Domains\Condo\Boundary\Input\CreateAssetRequest",["unitId"=>1,"type"=>"AUTOMOVIL","description"=>"Mustang rojo"]);
      $this->assertEquals("AUTOMOVIL", $createAssetRequest->type);
    }

    public function test_should_create_request_object_with_description(){
      $createAssetRequest = $this->requestFactory->make("App\Domains\Condo\Boundary\Input\CreateAssetRequest",["unitId"=>1,"type"=>"AUTOMOVIL","description"=>"Mustang rojo"]);
      $this->assertEquals("Mustang rojo", $createAssetRequest->description);
    }

    public function test_should_create_request_object_with_unitId(){
      $createAssetRequest = $this->requestFactory->make("App\Domains\Condo\Boundary\Input\CreateAssetRequest",["unitId"=>1,"type"=>"AUTOMOVIL","description"=>"Mustang rojo"]);
      $this->assertEquals(1, $createAssetRequest->unitId);
    }

    public function test_should_create_use_case(){
      $dependencies = ["assetRepository" => new AssetRepositoryMock];
      $useCase = $this->useCaseFactory->make("CreateAssetUseCase",$dependencies);
      $this->assertTrue(is_a($useCase, "App\Domains\Condo\UseCase\CreateAssetUseCase"));
    }

    public function test_should_create_asset(){
      $createAssetRequest = $this->requestFactory->make("App\Domains\Condo\Boundary\Input\CreateAssetRequest",["unitId"=>1,"type"=>"AUTOMOVIL","description"=>"Mustang rojo"]);
      $dependencies = ["assetRepository" => new AssetRepositoryMock];
      $useCase = $this->useCaseFactory->make("CreateAssetUseCase",$dependencies);
      $useCase->execute($createAssetRequest, function($response){
        $this->assertNotEmpty($response->assetDS->id);
        $this->assertEquals(1,$response->assetDS->unitId);
        $this->assertEquals("Mustang rojo",$response->assetDS->description);
        $this->assertEquals("AUTOMOVIL", $response->assetDS->type);
      });
    }

    public function test_should_fail_on_create_because_of_invalid_type(){
      $createAssetRequest = $this->requestFactory->make("App\Domains\Condo\Boundary\Input\CreateAssetRequest",[
        "unitId" => 1,
        "type" => "NO EXISTE",
        "description" => "Mustang rojo"
      ]);
      $dependencies = ["assetRepository" => new AssetRepositoryMock];
      $useCase = $this->useCaseFactory->make("CreateAssetUseCase",$dependencies);
      $useCase->execute($createAssetRequest, function($response){
       $this->assertEquals('MSG_ERR_INVALID_TYPE',$response->errors[0]["type"]);
      });
    }

    public function test_should_fail_on_create_because_of_negative_unit_id(){
      $createAssetRequest = $this->requestFactory->make("App\Domains\Condo\Boundary\Input\CreateAssetRequest",[
        "unitId" => -1,
        "type" => "AUTOMOVIL",
        "description" => "Mustang rojo"
      ]);
      $dependencies = ["assetRepository" => new AssetRepositoryMock];
      $useCase = $this->useCaseFactory->make("CreateAssetUseCase",$dependencies);
      $useCase->execute($createAssetRequest, function($response){
       $this->assertEquals('MSG_ERR_MUST_BE_POSITIVE',$response->errors[0]["unitId"]);
      });
    }
}
