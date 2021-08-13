<?php
namespace App\Interactor\Unit;

use App\Boundary\DS\UnitDS;
use App\Interactor\Interactor;
use App\Boundary\InputPort;
use App\Boundary\OutputPort;
use Illuminate\Support\Facades\Log;
use App\Factory\OutputPortFactory;
use App\Models\Unit;
use App\Boundary\Output\Unit\FindUnitsByCriteriaOutputPort;

class FindUnitsByCriteriaInteractor extends Interactor {
    public function execute(InputPort $inputPort){
        $errors = $inputPort->validate();
        if(!empty($errors))
            return OutputPortFactory::makeFailResponse($errors);
  
        return $this->makeSuccessResponse(Unit::all());
    }

    private function makeSuccessResponse($units){
        $output = new FindUnitsByCriteriaOutputPort();
        $output->success = true;
        $unitsDS = array();
        foreach($units as $unit)
            array_push($unitsDS,$this->mapUnitDS($unit));
        
        $output->units = $unitsDS;
        return $output;
    }

    private function mapUnitDS($unit){
        $unitDS = new UnitDS();
        $unitDS->id = $unit->id;
        $unitDS->description = $unit->description;
        return $unitDS;
    }
}