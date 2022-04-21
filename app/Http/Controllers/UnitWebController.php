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
    // private $createUnitUseCase;
    // private $editUnitUseCase;
    private $findUnitByIdUseCase;
    // private $findUnitsByCriteriaUseCase;
    // private $deleteUnitUseCase;

    public function __construct()
    {
        $useCaseFactory = app(UseCaseFactory::class);
        $this->requestFactory = app(RequestFactory::class);
    //     $this->createUnitUseCase = $useCaseFactory->make('App\Domains\Condo\UseCase\CreateUnitUseCase');
    //     $this->editUnitUseCase = $useCaseFactory->make('App\Domains\Condo\UseCase\EditUnitUseCase');
        $this->findUnitByIdUseCase = $useCaseFactory->make(FIND_UNIT_BY_ID_USE_CASE);
    //     $this->findUnitsByCriteriaUseCase = $useCaseFactory->make('App\Domains\Condo\UseCase\FindUnitsByCriteriaUseCase');
    //     $this->deleteUnitUseCase = $useCaseFactory->make('App\Domains\Condo\UseCase\DeleteUnitUseCase');
    }

    public function index()
    {
        // $this->returnView = view('unit.failure');
        // $findUnitsByCriteriaRequest = $this->requestFactory->make("App\Domains\Condo\Boundary\Input\FindUnitsByCriteriaRequest", 
        //                     ["description" => $request->description]);
        
        // $this->findUnitsByCriteriaUseCase->execute($findUnitsByCriteriaRequest, function($response){
        //     if($response->errors) 
        //         $this->returnView = view('unit.failure')->with("error", $response->errors[0]["description"]);
        //     else
        //         $this->returnView = view('unit.index', ["unitIndexVm"=> UnitWebController::createUnitIndexVm($response->unitsDS)]); 
        // });

        // return $this->returnView;
        return view('unit.index');
    }

    public function create()
    {
        return view('unit.create');
    }

    public function store(Request $request)
    {
        // $this->returnView = view('unit.failure');
        // $createUnitRequest = $this->requestFactory->make("App\Domains\Condo\Boundary\Input\CreateUnitRequest",
        //                     ["description"=>$request->description]);
        // $this->createUnitUseCase->execute($createUnitRequest,function($response){
        //     $this->returnView = redirect()->route('unit.index')->with('success', 'Unit succesfully created');
        // });

        // return $this->returnView;
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


    public function update(Request $request, $id)
    {
        // $editUnitRequest = $this->requestFactory->make("App\Domains\Condo\Boundary\Input\EditUnitRequest",
        //                 ["description"=>$request->description, "id"=> $id]);
        
        // $this->editUnitUseCase->execute($editUnitRequest,function($response){
        //     if($response->errors) 
        //         $this->returnView = view('unit.failure')->with("error", $response->errors[0]["id"]);
        //     else 
        //         $this->returnView = view('unit.show',["unitShowVm"=> UnitWebController::makeUnitShowVm($response->unitDS)]);
        // });
        // return $this->returnView;
    }

    // public static function createUnitIndexVm($unitsDS){
    //     $unitIndexVm = new UnitIndexVm;
    //     $unitsVm = [];
    //     foreach($unitsDS as $unitDS){
    //         $unitVm = new UnitVm;
    //         $unitVm->id = $unitDS->id;
    //         $unitVm->description = $unitDS->description;
    //         $btnShow = '
    //         <a href="'.route('unit.show', $unitVm->id).'" class="btn btn-xs text-teal mx-1" title="Show">
    //             <i class="fa fa-lg fa-fw fa-eye"></i>
    //         </a>';
    //         $btnEdit = '
    //         <a href="'.route('unit.edit', $unitVm->id).'" class="btn btn-xs text-primary mx-1" title="Edit">
    //             <i class="fa fa-lg fa-fw fa-pen"></i>
    //         </a>';
    //         $btnDelete = '
    //         <form action="'.route('unit.destroy', $unitVm->id).'" method="POST" class="d-inline">
    //             <input type="hidden" name="_token" value="'.csrf_token().'">
    //             <input type="hidden" name="_method" value="delete">
    //             <button type="submit" class="btn btn-xs text-danger mx-1" title="Delete">
    //                 <i class="fa fa-lg fa-fw fa-trash"></i>
    //             </button>
    //         </form>';
    //         $unitVm->buttons = $btnShow.$btnEdit.$btnDelete;
    //         array_push($unitsVm,$unitVm);
    //     }

    //     $unitIndexVm->unitsVm = $unitsVm;
    //     return $unitIndexVm;
    // }

    public static function makeUnitVm($unitDS){
        $unitVm = new UnitVm;
        $unitVm->id = $unitDS->id;
        $unitVm->description = $unitDS->description;
        return $unitVm;
    }    
}