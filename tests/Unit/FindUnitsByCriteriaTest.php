<?php
namespace Tests\Unit;
use App\Factory\InputPortFactory;
use App\Factory\InteractorFactory;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;
class FindUnitsByCriteriaUseCaseTest extends TestCase{

    public function test_create_input_port()
    {
        $inputPort = InputPortFactory::make("App\Boundary\Input\Unit\FindUnitsByCriteriaInputPort",["description"=>"Hello World"]);
        $this->assertEquals("Hello World",$inputPort->description);
    }

    public function test_create_interactor(){
        $interactor = InteractorFactory::make("App\Interactor\Unit\FindUnitsByCriteriaInteractor");
        $this->assertNotNull($interactor);
    }

    public function test_execute_interactor(){
        $interactor = InteractorFactory::make("App\Interactor\Unit\FindUnitsByCriteriaInteractor");
        $inputPort = InputPortFactory::make("App\Boundary\Input\Unit\FindUnitsByCriteriaInputPort",["description"=>"Hello World"]);
        
        $output = $interactor->execute($inputPort);
        $this->assertTrue($output->success);
    }
}

