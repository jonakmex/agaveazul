<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use Tests\Feature\Shared\Factory\RequestFactoryMock;
use Tests\Feature\Shared\Factory\UseCaseFactoryMock;
use Tests\Feature\Condo\Repository\AssetRepositoryMock;

class EditAssetTest extends TestCase
{
    private $useCaseFactory;
    private $requestFactory;

    public function setUp() :void{
        parent::setUp();
        $this->useCaseFactory = new UseCaseFactoryMock;
        $this->requestFactory = new RequestFactoryMock;
    }

    public function test_should_create_request_object(){
        $editAssetRequest = $this->requestFactory->make("App\Domains\Condo\Boundary\Input\EditAssetRequest",["id"=> 1, "description"=>"carro rojo mustang 68", "type"=>"AUTOMOVIL"]);
        $this->assertTrue(is_a($editAssetRequest,"App\Domains\Condo\Boundary\Input\EditAssetRequest"));
    }

    public function test_should_create_use_case(){
        $dependencies = ["assetRepository"=> new AssetRepositoryMock];
        $useCase = $this->useCaseFactory->make("EditAssetUseCase", $dependencies);
        $this->assertTrue(is_a($useCase, "App\Domains\Condo\UseCase\EditAssetUseCase"));
    }

    public function test_should_edit_asset(){
        $editAssetRequest = $this->requestFactory->make("App\Domains\Condo\Boundary\Input\EditAssetRequest",["id"=> 1, "description"=>"carro rojo mustang 68", "type"=>"AUTOMOVIL"]);
        $dependencies = ["assetRepository"=> new AssetRepositoryMock];
        $useCase = $this->useCaseFactory->make("EditAssetUseCase", $dependencies);
        $useCase->execute($editAssetRequest, function($response){
            $this->assertEquals(1,$response->assetDS->id);
            $this->assertEquals('carro rojo mustang 68',$response->assetDS->description);
        });
    }

    public function test_should_fail_because_of_invalid_type(){
        $editAssetRequest = $this->requestFactory->make("App\Domains\Condo\Boundary\Input\EditAssetRequest",["id"=> 1, "description"=>"carro rojo mustang 68", "type"=>"NO EXISTE"]);
        $dependencies = ["assetRepository"=> new AssetRepositoryMock];
        $useCase = $this->useCaseFactory->make("EditAssetUseCase", $dependencies);
        $useCase->execute($editAssetRequest, function($response){
            $this->assertEquals('MSG_ERR_INVALID_TYPE', $response->errors[0]["type"]);
        });
    }
}