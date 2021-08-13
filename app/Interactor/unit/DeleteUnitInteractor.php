<?php
namespace App\Interactor\Unit;

use App\Interactor\Interactor;
use App\Boundary\InputPort;
use App\Models\Unit;
use App\Factory\OutputPortFactory;
use App\Boundary\Output\DeleteUnitOutputPort;


class DeleteUnitInteractor extends Interactor {
    public function execute(InputPort $inputPort){
        $errors = $inputPort->validate();
        if(!empty($errors))
            return OutputPortFactory::makeFailResponse($errors);
        
        $unit = Unit::find($inputPort->id);
        $unit->delete();
        return $this->makeSuccessResponse();
    }

    private function makeSuccessResponse(){
        $output = new DeleteUnitOutputPort();
        $output->success = true;
        return $output;
    }
}