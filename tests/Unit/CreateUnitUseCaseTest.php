<?php

namespace Tests\Unit;

use App\Factory\InputPortFactory;
use PHPUnit\Framework\TestCase;

class CreateUnitUseCaseTest extends TestCase
{
    public function create_input_port()
    {
        $inputPort = InputPortFactory::make("CreateUnitInputPort",["description"=>"Hello World"]);
        $this->assertEquals("Hello World",$inputPort->description);
    }

    public function validate_input_port() 
    {
        $inputPort = InputPortFactory::make("CreateUnitInputPort",["description"=>""]);
        $errors = $inputPort->validate();
        $this->assertNotEmpty($errors);
    }
}
