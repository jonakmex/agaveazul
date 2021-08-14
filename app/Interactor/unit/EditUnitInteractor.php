<?php
namespace App\Interactor\Unit;

use App\Interactor\Interactor;
use App\Boundary\InputPort;
use App\Boundary\OutputPort;
use Illuminate\Support\Facades\Log;
use App\Models\Unit;
use App\Factory\OutputPortFactory;
use App\Boundary\Output\Unit\EditUnitOutputPort;


class EditUnitInteractor extends Interactor {
    public function execute(InputPort $inputPort){
        $errors = $inputPort->validate();
        if(!empty($errors))
            return OutputPortFactory::makeFailResponse($errors);

        $unit = Unit::find($inputPort->id);
        $unit->description = $inputPort->description;
        $unit->save();
        return $this->makeSuccessResponse($unit);
    }

    private function makeSuccessResponse($unit){
        $output = new EditUnitOutputPort;
        $output->success = true;
        $output->unit = $unit;
        return $output;
    }
}