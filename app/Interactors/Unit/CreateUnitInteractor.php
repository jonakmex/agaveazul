<?php

namespace App\Interactors\Unit;

use App\Interactors\DS\Unit\UnitCreated;
use App\Interactors\Interactor;
use App\Interactors\Ports\Input;
use App\Interactors\Ports\Output\Unit\CreateUnitOutputPort;
use App\Models\Unit;


class CreateUnitInteractor implements Interactor
{
    public function execute(Input $input){
        $errors = $input->validate();
        $output = new CreateUnitOutputPort;
        if(empty($errors)){
            $unit = $this->mapInputToUnit($input);
            $unit->save(); 
            $output->success = true;
            $output->unit = $this->mapUnitToUnitCreated($unit);
        }
        else{
            $output->success = false;
            $output->errors = $errors;
        }    
        return $output;
    }

    public function mapUnitToUnitCreated(Unit $unit){
        $unitCreated = new UnitCreated;
        $unitCreated->id = $unit->id;
        $unitCreated->description = $unit->description;
        $unitCreated->reference = $unit->reference;
        $unitCreated->balance = $unit->balance;
        $unitCreated->active = $unit->active;
        return $unitCreated;
    }

    public function mapInputToUnit($input){
        $unit = new Unit;
        $unit->description = $input->description;
        $unit->reference = $input->reference;
        return $unit;
    }
}