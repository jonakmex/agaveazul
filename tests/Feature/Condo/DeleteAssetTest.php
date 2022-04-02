<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use Tests\Feature\Shared\Factory\RequestFactoryMock;
use Tests\Feature\Shared\Factory\UseCaseFactoryMock;
use Tests\Feature\Condo\Repository\AssetRepositoryMock;

class DeleteAssetTest extends TestCase
{
    private $useCaseFactory;
    private $requestFactory;

    public function setUp() :void{
        parent::setUp();
        $this->useCaseFactory = new UseCaseFactoryMock;
        $this->requestFactory = new RequestFactoryMock;
    }

    public function test_should_create_request_object(){
        $deleteAssetRequest = $this->requestFactory->make("App\Domains\Condo\Boundary\Input\DeleteAssetRequest",["id"=> 1]);
        $this->assertTrue(is_a($deleteAssetRequest,"App\Domains\Condo\Boundary\Input\DeleteAssetRequest"));
    }

    public function test_should_create_use_case(){
        $dependencies = ["assetRepository"=> new AssetRepositoryMock];
        $useCase = $this->useCaseFactory->make("DeleteAssetUseCase", $dependencies);
        $this->assertTrue(is_a($useCase, "App\Domains\Condo\UseCase\DeleteAssetUseCase"));
    }

    public function test_should_delete_an_asset(){
        $deleteAssetRequest = $this->requestFactory->make("App\Domains\Condo\Boundary\Input\DeleteAssetRequest",["id"=> 1]);
        $dependencies = ["assetRepository"=> new AssetRepositoryMock];
        $useCase = $this->useCaseFactory->make("DeleteAssetUseCase", $dependencies);
        $useCase->execute($deleteAssetRequest, function($response){
            $this->assertEquals(1,$response->assetDS->id);
        });
    }
}