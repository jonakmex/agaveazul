<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use Tests\Feature\Shared\Factory\RequestFactoryMock;
use Tests\Feature\Shared\Factory\UseCaseFactoryMock;
use Tests\Feature\Condo\Repository\AssetRepositoryMock;

class FindAssetByIdTest extends TestCase
{
    private $useCaseFactory;
    private $requestFactory;

    public function setUp() :void{
        parent::setUp();
        $this->useCaseFactory = new UseCaseFactoryMock;
        $this->requestFactory = new RequestFactoryMock;
    }

    public function test_should_create_request_object(){
        $findAssetByIdRequest = $this->requestFactory->make("App\Domains\Condo\Boundary\Input\FindAssetByIdRequest",["id"=> 1]);
        $this->assertTrue(is_a($findAssetByIdRequest,"App\Domains\Condo\Boundary\Input\FindAssetByIdRequest"));
    }

    public function test_should_create_request_object_with_type(){
        $findAssetByIdRequest = $this->requestFactory->make("App\Domains\Condo\Boundary\Input\FindAssetByIdRequest",["id"=> 1]);
        $this->assertEquals(1, $findAssetByIdRequest->id);
    }

    public function test_should_create_use_case(){
        $dependencies = ["assetRepository" => new AssetRepositoryMock];
        $useCase = $this->useCaseFactory->make('FindAssetByIdUseCase', $dependencies);
        $this->assertTrue(is_a($useCase, "App\Domains\Condo\UseCase\FindAssetByIdUseCase"));
    }

    public function test_should_find_asset_given_id(){
        $findAssetByIdRequest = $this->requestFactory->make("App\Domains\Condo\Boundary\Input\FindAssetByIdRequest",["id"=> 1]);
        $dependencies = ["assetRepository" => new AssetRepositoryMock];
        $useCase = $this->useCaseFactory->make('FindAssetByIdUseCase', $dependencies);
        $useCase->execute($findAssetByIdRequest, function($response){
            $this->assertEquals(1,$response->assetDS->id);
        });
    }

    public function test_should_fail_beacuse_negative_id(){
        $findAssetByIdRequest = $this->requestFactory->make("App\Domains\Condo\Boundary\Input\FindAssetByIdRequest",["id"=> -1]);
        $dependencies = ["assetRepository" => new AssetRepositoryMock];
        $useCase = $this->useCaseFactory->make('FindAssetByIdUseCase', $dependencies);
        $useCase->execute($findAssetByIdRequest, function($response){
            $this->assertEquals("ERR_MSG_MUST_BE_POSITIVE",$response->errors[0]["id"]);
        });
    }
}