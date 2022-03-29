<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Domains\Shared\Boundary\RequestFactory;
use App\Domains\Shared\UseCase\UseCaseFactory;


class UnitWebController extends Controller
{
    private $returnView;
    private $createUnitUseCase;
    private $editUnitUseCase;
    private $findUnitByIdUseCase;
    private $findUnitsByCriteriaUseCase;

    public function __construct()
    {
        $useCaseFactory = app(UseCaseFactory::class);
        $this->createUnitUseCase = $useCaseFactory->make('CreateUnitUseCase');
        $this->editUnitUseCase = $useCaseFactory->make('EditUnitUseCase');
        $this->findUnitByIdUseCase = $useCaseFactory->make('FindUnitByIdUseCase');
        $this->findUnitByIdUseCase = $useCaseFactory->make('FindUnitByIdUseCase');
        $this->findUnitsByCriteriaUseCase = $useCaseFactory->make('FindUnitsByCriteriaUseCase');
    }

    public function index(Request $request)
    {
        $this->returnView = view('unit.failure');
        $findUnitsByCriteriaRequest = RequestFactory::make("FindUnitsByCriteriaRequest", 
                            ["description" => $request->description]);
        
        $this->findUnitsByCriteriaUseCase->execute($findUnitsByCriteriaRequest, function($response){
            if($response->errors) 
                $this->returnView = view('unit.failure')->with("error", $response->errors[0]["description"]);
            else
                $this->returnView = view('unit.index', ["units"=> $response->unitsDS]); 
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
        $createUnitRequest = RequestFactory::make("CreateUnitRequest",
                            ["description"=>$request->description]);
        $this->createUnitUseCase->execute($createUnitRequest,function($response){
            $this->returnView = redirect()->route('unit.index')->with('success', 'Unit succesfully created');
        });

        return $this->returnView;
    }

    public function show($id)
    {
        $this->returnView = view('unit.failure');
        $findUnitByIdRequest = RequestFactory::make("FindUnitByIdRequest",
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
        $findUnitByIdRequest = RequestFactory::make("FindUnitByIdRequest",
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
        $editUnitRequest = RequestFactory::make("EditUnitRequest",
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
        $deleteUnitRequest = RequestFactory::make("DeleteUnitRequest", 
                                ["id"=> $id]);
        
        $this->deleteUnitUseCase->execute($deleteUnitRequest,function($response){
            if($response->errors) 
                $this->returnView = view('unit.failure')->with("error", $response->errors[0]["id"]);
            else 
                $this->returnView = redirect()->route('unit.index')->with('success','unit succesfully removed');
        });
        return $this->returnView;
    }
}