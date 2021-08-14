<?php

namespace Tests\Unit;

use App\Factory\InputPortFactory;
use App\Factory\InteractorFactory;
use Illuminate\Support\Facades\Log;

use Tests\TestCase;


class EditUnitUseCaseTest extends TestCase{

    public function test_create_input_port()
    {
        $inputPort = InputPortFactory::make("App\Boundary\Input\Unit\EditUnitInputPort",["description"=>"Hello World"]);
        $this->assertEquals("Hello World",$inputPort->description);
    }

    public function test_validate_input_port_invalid_input() 
    {
        $inputPort = InputPortFactory::make("App\Boundary\Input\Unit\EditUnitInputPort",["description"=>""]);
        $errors = $inputPort->validate();
        $this->assertNotEmpty($errors);
    }

    public function test_create_interactor(){
        $interactor = InteractorFactory::make("App\Interactor\Unit\EditUnitInteractor");
        $this->assertNotNull($interactor);
    }
}