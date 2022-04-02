<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use Tests\Feature\Shared\Factory\RequestFactoryMock;
use Tests\Feature\Shared\Factory\UseCaseFactoryMock;
use Tests\Feature\Condo\Repository\AssetRepositoryMock;

class FindAssetsByCriteriaTest extends TestCase
{

    private $useCaseFactory;
    private $requestFactory;

    public function setUp() :void{
        parent::setUp();
        $this->useCaseFactory = new UseCaseFactoryMock;
        $this->requestFactory = new RequestFactoryMock;
    }

    public function test_should_create_request_object(){
        $findAssetsByCriteriaRequest = $this->requestFactory->make(
            "App\Domains\Condo\Boundary\Input\FindAssetsByCriteriaRequest",[
                "description" => "Carro rojo",
                "type" => "AUTOMOVIL",
                "unitId" => 1
            ]
        );
        $this->assertTrue(is_a($findAssetsByCriteriaRequest,"App\Domains\Condo\Boundary\Input\FindAssetsByCriteriaRequest"));
    }

    public function test_should_create_use_case(){
        $dependencies = ["assetRepository"=>new AssetRepositoryMock];
        $useCase = $this->useCaseFactory->make("FindAssetsByCriteriaUseCase", $dependencies);

        $this->assertTrue(is_a($useCase, "App\Domains\Condo\UseCase\FindAssetsByCriteriaUseCase"));
    }

    public function test_should_list_all_assets_without_passing_criteria(){
        $findAssetsByCriteriaRequest = $this->requestFactory->make(
            "App\Domains\Condo\Boundary\Input\FindAssetsByCriteriaRequest",[
                "description" => null,
                "type" => null,
                "unitId" => 1
            ]
        );
        $dependencies = ["assetRepository"=>new AssetRepositoryMock];
        $useCase = $this->useCaseFactory->make("FindAssetsByCriteriaUseCase", $dependencies);
        $useCase->execute($findAssetsByCriteriaRequest, function($response){
            $this->assertNotEmpty($response->assetsDS);
        });
    }

    public function test_should_list_all_assets_given_criteria(){
        $findAssetsByCriteriaRequest = $this->requestFactory->make(
            "App\Domains\Condo\Boundary\Input\FindAssetsByCriteriaRequest",[
                "description" => "5050",
                "type" => "REF_BANCO",
                "unitId" => 10
            ]
        );
        $dependencies = ["assetRepository"=>new AssetRepositoryMock];
        $useCase = $this->useCaseFactory->make("FindAssetsByCriteriaUseCase", $dependencies);
        $useCase->execute($findAssetsByCriteriaRequest, function($response){
            $this->assertNotEmpty($response->assetsDS);
        });
    }
    
    public function test_should_not_list_all_assets(){
        $findAssetsByCriteriaRequest = $this->requestFactory->make(
            "App\Domains\Condo\Boundary\Input\FindAssetsByCriteriaRequest",[
                "description" => "noexiste",
                "type" => "AUTOMOVIL",
                "unitId" => 1
            ]
        );
        $dependencies = ["assetRepository"=>new AssetRepositoryMock];
        $useCase = $this->useCaseFactory->make("FindAssetsByCriteriaUseCase", $dependencies);
        $useCase->execute($findAssetsByCriteriaRequest, function($response){
            $this->assertEmpty($response->assetsDS);
        });
    }

    public function test_should_show_invalid_type(){
        $findAssetsByCriteriaRequest = $this->requestFactory->make(
            "App\Domains\Condo\Boundary\Input\FindAssetsByCriteriaRequest",[
                "description" => null,
                "type" => "NO EXISTE",
                "unitId" => 1
            ]
        );
        $dependencies = ["assetRepository"=>new AssetRepositoryMock];
        $useCase = $this->useCaseFactory->make("FindAssetsByCriteriaUseCase", $dependencies);
        $useCase->execute($findAssetsByCriteriaRequest, function($response){
            $this->assertEquals("MSG_ERR_INVALID_TYPE", $response->errors[0]["type"]);
        });
    }
}