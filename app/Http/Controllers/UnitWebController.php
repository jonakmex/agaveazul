<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Domains\Shared\Boundary\RequestFactory;
use App\Domains\Shared\UseCase\UseCaseFactory;
use App\Http\Controllers\ViewModel\UnitIndexVm;
use App\Http\Controllers\ViewModel\UnitVm;

class UnitWebController extends Controller
{
    private $returnView;
    private $requestFactory;
    private $createUnitUseCase;
    private $editUnitUseCase;
    private $findUnitByIdUseCase;
    private $findUnitsByCriteriaUseCase;
    private $deleteUnitUseCase;

    public function __construct()
    {
        $useCaseFactory = app(UseCaseFactory::class);
        $this->requestFactory = app(RequestFactory::class);
        $this->createUnitUseCase = $useCaseFactory->make('App\Domains\Condo\UseCase\CreateUnitUseCase');
        $this->editUnitUseCase = $useCaseFactory->make('App\Domains\Condo\UseCase\EditUnitUseCase');
        $this->findUnitByIdUseCase = $useCaseFactory->make('App\Domains\Condo\UseCase\FindUnitByIdUseCase');
        $this->findUnitsByCriteriaUseCase = $useCaseFactory->make('App\Domains\Condo\UseCase\FindUnitsByCriteriaUseCase');
        $this->deleteUnitUseCase = $useCaseFactory->make('App\Domains\Condo\UseCase\DeleteUnitUseCase');
    }

    public function index(Request $request)
    {
        $this->returnView = view('unit.failure');
        $findUnitsByCriteriaRequest = $this->requestFactory->make("App\Domains\Condo\Boundary\Input\FindUnitsByCriteriaRequest", 
                            ["description" => $request->description]);
        
        $this->findUnitsByCriteriaUseCase->execute($findUnitsByCriteriaRequest, function($response){
            if($response->errors) 
                $this->returnView = view('unit.failure')->with("error", $response->errors[0]["description"]);
            else
                $this->returnView = view('unit.index', ["unitIndexVm"=> UnitWebController::createUnitIndexVm($response->unitsDS)]); 
        });

        return $this->returnView;
    }

    public function create()
    {
        return view('unit.create');
    }

    public function store(Request $request)
    {
        $this->returnView = view('unit.failure');
        $createUnitRequest = $this->requestFactory->make("App\Domains\Condo\Boundary\Input\CreateUnitRequest",
                            ["description"=>$request->description]);
        $this->createUnitUseCase->execute($createUnitRequest,function($response){
            $this->returnView = redirect()->route('unit.index')->with('success', 'Unit succesfully created');
        });

        return $this->returnView;
    }

    public function show($id)
    {
        $this->returnView = view('unit.failure');
        $findUnitByIdRequest = $this->requestFactory->make("App\Domains\Condo\Boundary\Input\FindUnitByIdRequest",
                                    ["id"=>$id]);
        
        $this->findUnitByIdUseCase->execute($findUnitByIdRequest,function($response){
            if($response->errors) 
                $this->returnView = view('unit.failure')->with("error", $response->errors[0]["id"]);
            else 
                $this->returnView = view('unit.show',['unit' => $response->unitDS]);
        });

        return $this->returnView;
    }


    public function edit($id)
    {
         $this->returnView = view('unit.failure');
        $findUnitByIdRequest = $this->requestFactory->make("App\Domains\Condo\Boundary\Input\FindUnitByIdRequest",
                                ["id"=>$id]);
        
        $this->findUnitByIdUseCase->execute($findUnitByIdRequest,function($response){
            if($response->errors) 
                $this->returnView = view('unit.failure')->with("error", $response->errors[0]["id"]);
            else 
                $this->returnView = view('unit.edit',['unit' => $response->unitDS]);
        });

        return $this->returnView;
    }


    public function update(Request $request, $id)
    {
        $editUnitRequest = $this->requestFactory->make("App\Domains\Condo\Boundary\Input\EditUnitRequest",
                        ["description"=>$request->description, "id"=> $id]);
        
        $this->editUnitUseCase->execute($editUnitRequest,function($response){
            if($response->errors) 
                $this->returnView = view('unit.failure')->with("error", $response->errors[0]["id"]);
            else 
                $this->returnView = view('unit.show',['unit' => $response->unitDS]);
        });
        return $this->returnView;
    }


    public function destroy($id)
    {
        $deleteUnitRequest = $this->requestFactory->make("App\Domains\Condo\Boundary\Input\DeleteUnitRequest", 
                                ["id"=> $id]);
        
        $this->deleteUnitUseCase->execute($deleteUnitRequest,function($response){
            if($response->errors) 
                $this->returnView = view('unit.failure')->with("error", $response->errors[0]["id"]);
            else 
                $this->returnView = redirect()->route('unit.index')->with('success','unit succesfully removed');
        });
        return $this->returnView;
    }

    public static function createUnitIndexVm($unitsDS){
        $unitIndexVm = new UnitIndexVm;
        $unitsVm = [];
        foreach($unitsDS as $unitDS){
            $unitVm = new UnitVm;
            $unitVm->id = $unitDS->id;
            $unitVm->description = $unitDS->description;
            $editRoute = route('unit.edit',$unitDS->id);
            $deleteRoute = route('unit.destroy',$unitDS->id);
            $unitVm->btnEdit = '<a href="'.$editRoute.'" class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
            <i class="fa fa-lg fa-fw fa-pen"></i>
            </a>';
            $unitVm->btnDelete = '<button href="'.$editRoute.'"class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
            <i class="fa fa-lg fa-fw fa-trash"></i>
            </button>';

            array_push($unitsVm,$unitVm);
        }
        $unitIndexVm->unitsVm = $unitsVm;
        return $unitIndexVm;
    }
}