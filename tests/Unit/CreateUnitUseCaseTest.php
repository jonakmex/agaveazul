<?php

namespace Tests\Unit;

use App\Factory\InputPortFactory;
use App\Factory\InteractorFactory;

use PHPUnit\Framework\TestCase;


class CreateUnitUseCaseTest extends TestCase
{

    public function test_create_input_port()
    {
        $inputPort = InputPortFactory::make("App\Boundary\Input\CreateUnitInputPort",["description"=>"Hello World"]);
        $this->assertEquals("Hello World",$inputPort->description);
    }

    public function test_validate_input_port_invalid_input() 
    {
        $inputPort = InputPortFactory::make("App\Boundary\Input\CreateUnitInputPort",["description"=>""]);
        $errors = $inputPort->validate();
        $this->assertNotEmpty($errors);
    }

    public function test_validate_input_port_null_input() 
    {
        $inputPort = InputPortFactory::make("App\Boundary\Input\CreateUnitInputPort");
        $errors = $inputPort->validate();
        $this->assertNotEmpty($errors);
    }

    public function test_validate_input_port_null_value() 
    {
        $inputPort = InputPortFactory::make("App\Boundary\Input\CreateUnitInputPort",["fake"=>""]);
        $errors = $inputPort->validate();
        $this->assertNotEmpty($errors);
    }

    public function test_create_interactor(){
        $interactor = InteractorFactory::make("App\Interactor\Unit\CreateUnitInteractor");
        $this->assertNotNull($interactor);
    }
}
