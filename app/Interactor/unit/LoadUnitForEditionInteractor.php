<?php
namespace App\Interactor\Unit;

use App\Interactor\Interactor;
use App\Boundary\InputPort;
use App\Boundary\OutputPort;
use Illuminate\Support\Facades\Log;
use App\Models\Unit;
use App\Factory\OutputPortFactory;
use App\Boundary\Output\Unit\LoadUnitForEditionOutputPort;
use App\Boundary\DS\UnitDS;


class LoadUnitForEditionInteractor extends Interactor {
    public function execute(InputPort $inputPort){
        
        $errors = $inputPort->validate();
        if(!empty($errors))
            return OutputPortFactory::makeFailResponse($errors);

        $unit = Unit::find($inputPort->id);
        
        return $this->makeSuccessResponse($unit);
    }

    private function makeSuccessResponse($unit){
        $output = new LoadUnitForEditionOutputPort();
        $output->success = true;
        if($unit != null)
            $output->unit = $unit;
        return $output;
    }
}