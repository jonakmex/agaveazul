<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Domains\Shared\Boundary\RequestFactory;
use App\Domains\Shared\UseCase\UseCaseFactory;
// use App\Http\Controllers\ViewModel\UnitIndexVm;
use App\Http\Controllers\ViewModel\UnitVm;

class UnitWebController extends Controller
{
    private $returnView;
    private $requestFactory;
    private $findUnitByIdUseCase;

    public function __construct()
    {
        $useCaseFactory = app(UseCaseFactory::class);
        $this->requestFactory = app(RequestFactory::class);
        $this->findUnitByIdUseCase = $useCaseFactory->make(FIND_UNIT_BY_ID_USE_CASE);
    }

    public function index()
    {
        return view('unit.index');
    }

    public function create()
    {
        return view('unit.create');
    }

    public function show($id)
    {
        $this->returnView = view('unit.failure');
        $findUnitByIdRequest = $this->requestFactory->make(FIND_UNIT_BY_ID_REQUEST, ["id"=>$id]);
        
        $this->findUnitByIdUseCase->execute($findUnitByIdRequest,function($response){
            if(!$response->errors)  
                $this->returnView = view('unit.show',["unitVm"=> UnitWebController::makeUnitVm($response->unitDS)]);
        });

        return $this->returnView;
    }

    public function edit($id)
    {
        $this->returnView = view('unit.failure');
        $findUnitByIdRequest = $this->requestFactory->make(FIND_UNIT_BY_ID_REQUEST, ["id"=>$id]);
        
        $this->findUnitByIdUseCase->execute($findUnitByIdRequest,function($response){
            if(!$response->errors) 
                $this->returnView = view('unit.edit',["unitVm"=> UnitWebController::makeUnitVm($response->unitDS)]);
        });

        return $this->returnView;
    }

    public static function makeUnitVm($unitDS){
        $unitVm = new UnitVm;
        $unitVm->id = $unitDS->id;
        $unitVm->description = $unitDS->description;
        return $unitVm;
    }    
}