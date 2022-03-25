<?php
namespace Tests\Feature;

use App\Domains\Condo\Entities\Unit;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Domains\Shared\Boundary\RequestFactory;
use App\Domains\Shared\UseCase\UseCaseFactory;
use Tests\Feature\Condo\Repository\UnitRepositoryMock;

class EditUnitTest extends TestCase 
{
    public function test_should_create_request_object()
    {
        $EditUnitRequest = RequestFactory::make("EditUnitRequest",["description"=>"Test 1", "id"=> 29]);
        $this->assertTrue(is_a($EditUnitRequest,"App\Domains\Condo\Boundary\Input\EditUnitRequest"));
        $this->assertEquals($EditUnitRequest->description,"Test 1");
        $this->assertEquals($EditUnitRequest->id, "29");
    }

    public function test_should_edit_unit(){
        $EditUnitRequest = RequestFactory::make("EditUnitRequest",["description"=>"Test 1", "id"=> 29]);
        $dependencies = ["unitRepository"=>new UnitRepositoryMock];
        $useCase = UseCaseFactory::make("EditUnitUseCase",$dependencies); 
        $useCase->execute($EditUnitRequest,function($response){
          $this->assertEquals($response->unitDS->id,"29");
        });
        
    }
}