<?php

namespace Tests\Feature\Condo;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Domains\Shared\Boundary\RequestFactory;
use App\Domains\Shared\UseCase\UseCaseFactory;
use Tests\Feature\Condo\Repository\UnitRepositoryMock;

class FindUnitByIdTest extends TestCase
{
    public function test_should_create_request_object(){
        $findUnitByIdRequest = RequestFactory::make("FindUnitByIdRequest",["id"=>1]);
        $this->assertTrue(
            is_a($findUnitByIdRequest,"App\Domains\Condo\Boundary\Input\FindUnitByIdRequest")
        );
    }

    public function test_should_create_request_object_with_id()
    {
        $findUnitByIdRequest = RequestFactory::make("FindUnitByIdRequest",["id"=>15]);
        $this->assertEquals($findUnitByIdRequest->id,15);
    }

    public function test_should_find_unit_given_id(){
        $findUnitByIdRequest = RequestFactory::make("FindUnitByIdRequest",["id"=>15]);
        $dependencies = ["unitRepository"=>new UnitRepositoryMock];

        $useCase = UseCaseFactory::make("FindUnitByIdUseCase",$dependencies);
        $useCase->execute($findUnitByIdRequest,function($response){
            $this->assertNotEmpty($response->unitDS->description);
            $this->assertEquals($response->unitDS->id, 15);
        });
    }

    public function test_should_show_must_be_positive(){
        $findUnitByIdRequest = RequestFactory::make("FindUnitByIdRequest",["id"=>-1]);
        $dependencies = ["unitRepository"=>new UnitRepositoryMock];

        $useCase = UseCaseFactory::make("FindUnitByIdUseCase",$dependencies);
        $useCase->execute($findUnitByIdRequest,function($response){
            $this->assertEquals($response->errors[0]["id"],"MSG_ERR_MUST_BE_POSITIVE");
        });
    }
}
