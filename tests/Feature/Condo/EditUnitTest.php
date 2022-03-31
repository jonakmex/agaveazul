<?php
namespace Tests\Feature;


use Tests\TestCase;

use Tests\Feature\Shared\Factory\RequestFactoryMock;
use Tests\Feature\Shared\Factory\UseCaseFactoryMock;
use Tests\Feature\Condo\Repository\UnitRepositoryMock;

class EditUnitTest extends TestCase 
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
        $EditUnitRequest = $this->requestFactory->make("App\Domains\Condo\Boundary\Input\EditUnitRequest",["description"=>"Test 1", "id"=> 29]);
        $this->assertTrue(is_a($EditUnitRequest,"App\Domains\Condo\Boundary\Input\EditUnitRequest"));
        $this->assertEquals($EditUnitRequest->description,"Test 1");
        $this->assertEquals($EditUnitRequest->id, "29");
    }

    public function test_should_edit_unit(){
        $EditUnitRequest = $this->requestFactory->make("App\Domains\Condo\Boundary\Input\EditUnitRequest",["description"=>"Test 1", "id"=> 29]);
        $dependencies = ["unitRepository"=>new UnitRepositoryMock];
        $useCase = $this->useCaseFactory->make("EditUnitUseCase",$dependencies); 
        $useCase->execute($EditUnitRequest,function($response){
          $this->assertEquals($response->unitDS->id,"29");
        });
        
    }
}