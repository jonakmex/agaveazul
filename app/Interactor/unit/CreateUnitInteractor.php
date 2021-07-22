<?php
namespace App\Interactor\Unit;

use App\Interactor\Interactor;
use App\Boundary\InputPort;
use App\Boundary\OutputPort;
use Illuminate\Support\Facades\Log;


class CreateUnitInteractor extends Interactor {
    public function execute(InputPort $inputPort,$callback){
        Log::debug($inputPort->description);
        $callback(new OutputPort);
    }
}