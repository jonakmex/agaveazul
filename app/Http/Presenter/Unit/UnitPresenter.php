<?php
namespace App\Http\Presenter\Unit;

use App\Http\ViewModel\Unit\UnitVM;
use App\Http\ViewModel\Unit\Index;

class UnitPresenter {

    public static function createSuccessIndex($output){
        $index = new Index;
        $index->success = true;
        $index->units = UnitPresenter::mapToUnitsVm($output->units);
        return $index;
    }

    public static function createFailIndex($output){
        $index = new Index;
        $index->success = false;
        $index->error = ['message'=>'Error Grave'];
        return $index;
    }

    public static function mapToUnitsVm ($unitsDS){
        $unitsVms = array();
        foreach($unitsDS as $unitDS)
            array_push($unitsVms,UnitPresenter::mapToUnitVm($unitDS));
        
        return $unitsVms;
    }

    public static function mapToUnitVm ($unitDS){
        $unitVm = new UnitVM;
        $unitVm->id = $unitDS->id;
        $unitVm->description = $unitDS->description;
        return $unitVm;
    }
}