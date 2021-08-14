<?php
namespace Tests\Unit;
use App\Factory\InputPortFactory;
use App\Factory\InteractorFactory;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class LoadUnitForEditionTest extends TestCase
{
    public function test_create_input_port()
    {
        $inputPort = InputPortFactory::make("App\Boundary\Input\Unit\LoadUnitForEditionInputPort");
        $this->assertNotNull($inputPort);
    }
    
    public function test_validate_input_port_invalid_input() 
    {
        $inputPort = InputPortFactory::make("App\Boundary\Input\Unit\LoadUnitForEditionInputPort",["id"=>""]);
        $errors = $inputPort->validate();
        $this->assertNotEmpty($errors);
    }

    public function test_create_interactor(){
        $interactor = InteractorFactory::make("App\Interactor\Unit\LoadUnitForEditionInteractor");
        $this->assertNotNull($interactor);
    }

    public function test_execute_interactor(){
        $interactor = InteractorFactory::make("App\Interactor\Unit\LoadUnitForEditionInteractor");
        $inputPort = InputPortFactory::make("App\Boundary\Input\Unit\LoadUnitForEditionInputPort",["id"=>20]);
        $output = $interactor->execute($inputPort);
        $this->assertNotNull($output);
    }
}