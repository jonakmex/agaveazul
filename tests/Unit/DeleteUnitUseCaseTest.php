<?php
namespace Tests\Unit;
use App\Factory\InputPortFactory;
use App\Factory\InteractorFactory;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;
class DeleteUnitUseCaseTest extends TestCase
{
    public function test_create_input_port()
    {
        $inputPort = InputPortFactory::make("App\Boundary\Input\Unit\DeleteUnitInputPort");
        $this->assertNotNull($inputPort);
    }

    public function test_validate_input_port_invalid_input() 
    {
        $inputPort = InputPortFactory::make("App\Boundary\Input\Unit\DeleteUnitInputPort",["id"=>"XXX"]);
        $errors = $inputPort->validate();
        $this->assertNotEmpty($errors);
    }

    public function test_validate_input_port_null_input() 
    {
        $inputPort = InputPortFactory::make("App\Boundary\Input\Unit\DeleteUnitInputPort");
        $errors = $inputPort->validate();
        $this->assertNotEmpty($errors);
    }

    public function test_create_interactor(){
        $interactor = InteractorFactory::make("App\Interactor\Unit\DeleteUnitInteractor");
        $this->assertNotNull($interactor);
    }

    public function test_execute_interactor(){
        $interactor = InteractorFactory::make("App\Interactor\Unit\DeleteUnitInteractor");
        $inputPort = InputPortFactory::make("App\Boundary\Input\Unit\DeleteUnitInputPort",["id"=>1]);
        
        $output = $interactor->execute($inputPort);
        $this->assertNotNull($output);
        $this->assertTrue($output->success);
    }
}