<?php
namespace App\Interactor\Unit;

use App\Interactor\Interactor;
use App\Boundary\InputPort;
use App\Boundary\OutputPort;
use Illuminate\Support\Facades\Log;
use App\Models\Unit;
use App\Factory\OutputPortFactory;
use App\Boundary\Output\Unit\CreateUnitOutputPort;


class CreateUnitInteractor extends Interactor {
    public function execute(InputPort $inputPort){
        Log::debug($inputPort->description);
        $errors = $inputPort->validate();
        if(!empty($errors))
            return OutputPortFactory::makeFailResponse($errors);

        $unit = new Unit;
        $unit->description = $inputPort->description;
        $unit->save();
        return $this->makeSuccessResponse($unit);
    }

    private function makeSuccessResponse($unit){
        $output = new CreateUnitOutputPort();
        $output->success = true;
        $output->id = $unit->id;
        $output->description=$unit->description;
        return $output;
    }
}