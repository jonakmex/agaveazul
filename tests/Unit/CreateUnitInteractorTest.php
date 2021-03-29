<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Interactors\InteractorFactory;
use App\Interactors\Ports\InputFactory;

use function PHPUnit\Framework\assertEmpty;
use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertNotNull;
use function PHPUnit\Framework\assertTrue;
use function PHPUnit\Framework\isEmpty;

class CreateUnitInteractorTest extends TestCase
{
    public function test_loads_interactor()
    {
        $interactor = InteractorFactory::make('Unit\CreateUnitInteractor');
        $this->assertInstanceOf('App\Interactors\Interactor',$interactor);
    }

    public function test_create_request_all_arguments()
    {
        $params = [
            "description" => "Hello World",
            "reference" => "Yes",
        ];
        $input = InputFactory::make('Unit\CreateUnitInputPort',$params);
        $this->assertInstanceOf('App\Interactors\Ports\Input\Unit\CreateUnitInputPort',$input);
        $this->assertEquals('Hello World',$input->description);
    }

    public function test_create_request_some_arguments()
    {
        $params = [
            "description" => "Hello World",
        ];
        $input = InputFactory::make('Unit\CreateUnitInputPort',$params);
        $this->assertInstanceOf('App\Interactors\Ports\Input\Unit\CreateUnitInputPort',$input);
        $this->assertEquals('Hello World',$input->description);
    }

    public function test_valid_data_for_creation()
    {
        $params = [
            "description" => "Casa 10",
            "reference" => "5108",
        ];
        $input = InputFactory::make('Unit\CreateUnitInputPort',$params);
        $errors = $input->validate();
        assertTrue(empty($errors));
    }

    public function test_invalid_description_min_for_creation()
    {
        $params = [
            "description" => "",
            "reference" => "5108",
        ];
        $input = InputFactory::make('Unit\CreateUnitInputPort',$params);
        $errors = $input->validate();
        assertTrue(array_key_exists('description',$errors));
        assertEquals('MSG_ERR_MIN',$errors['description']["message"]);
    }

    public function test_invalid_description_max_for_creation()
    {
        $params = [
            "description" => "kjslfksdfkjsldfkj sdlfjsdlkfj sdlkfj sldkfj sldkfj sdlkfj sdlkfj sldkfj sldkjf sdlkfj sdlfkj",
            "reference" => "5108",
        ];
        $input = InputFactory::make('Unit\CreateUnitInputPort',$params);
        $errors = $input->validate();
        assertTrue(array_key_exists('description',$errors));
        assertEquals('MSG_ERR_MAX',$errors['description']["message"]);
    }

    public function test_invalid_reference_min_for_creation()
    {
        $params = [
            "description" => "Casa 10",
            "reference" => "",
        ];
        $input = InputFactory::make('Unit\CreateUnitInputPort',$params);
        $errors = $input->validate();
        assertTrue(array_key_exists('reference',$errors));
        assertEquals('MSG_ERR_MIN',$errors['reference']["message"]);
    }

    public function test_invalid_reference_max_for_creation()
    {
        $params = [
            "description" => "Casa 10",
            "reference" => "kjslfksdfkjsldfkj sdlfjsdlkfj sdlkfj sldkfj sldkfj sdlkfj sdlkfj sldkfj sldkjf sdlkfj sdlfkj",
        ];
        $input = InputFactory::make('Unit\CreateUnitInputPort',$params);
        $errors = $input->validate();
        assertTrue(array_key_exists('reference',$errors));
        assertEquals('MSG_ERR_MAX',$errors['reference']["message"]);
    }

    public function test_unit_creation_success()
    {
        $params = [
            "description" => "Casa 10",
            "reference" => "5108",
        ];
        $input = InputFactory::make('Unit\CreateUnitInputPort',$params);
        $interactor = InteractorFactory::make('Unit\CreateUnitInteractor');
        $output = $interactor->execute($input);
        assertTrue($output->success);
        assertNotNull($output->unit->id);
    }
}
