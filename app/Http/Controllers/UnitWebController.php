<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Domains\Shared\Boundary\RequestFactory;
use App\Domains\Shared\UseCase\UseCaseFactory;
use App\Domains\Condo\Repository\UnitEloquentRepository;
use App\Models\UnitEloquent;

class UnitWebController extends Controller
{
    private $returnView;

    public function index()
    {
        //
    }

    public function create()
    {
        return view('unit.create');
    }

    public function store(Request $request)
    {
        $this->returnView = view('unit.failure');
        $createUnitRequest = RequestFactory::make("CreateUnitRequest",["description"=>$request->description]);
        $dependencies = ["unitRepository"=>new UnitEloquentRepository()];
        $useCase = UseCaseFactory::make("CreateUnitUseCase",$dependencies);
        $useCase->execute($createUnitRequest,function($response){
            $this->returnView = view('unit.success');
        });

        return $this->returnView;
    }

    public function show($id)
    {
        $this->returnView = view('unit.failure');
        $findUnitByIdRequest = RequestFactory::make("FindUnitByIdRequest",["id"=>$id]);
        $dependencies = ["unitRepository"=>new UnitEloquentRepository()];
        $useCase = UseCaseFactory::make("FindUnitByIdUseCase",$dependencies);
        $useCase->execute($findUnitByIdRequest,function($response){
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
        $findUnitByIdRequest = RequestFactory::make("FindUnitByIdRequest",["id"=>$id]);
        $dependencies = ["unitRepository"=>new UnitEloquentRepository()];
        $useCase = UseCaseFactory::make("FindUnitByIdUseCase",$dependencies);
        $useCase->execute($findUnitByIdRequest,function($response){
            if($response->errors) 
                $this->returnView = view('unit.failure')->with("error", $response->errors[0]["id"]);
            else 
                $this->returnView = view('unit.edit',['unit' => $response->unitDS]);
        });

        return $this->returnView;
    }


    public function update(Request $request, $id)
    {
        $editUnitRequest = RequestFactory::make("EditUnitRequest",["description"=>$request->description, "id"=> $id]);
        $dependencies = ["unitRepository"=>new UnitEloquentRepository()];
        $useCase = UseCaseFactory::make("EditUnitUseCase",$dependencies);
        $useCase->execute($editUnitRequest,function($response){
            if($response->errors) 
                $this->returnView = view('unit.failure')->with("error", $response->errors[0]["id"]);
            else 
                $this->returnView = view('unit.show',['unit' => $response->unitDS]);
        });
        return $this->returnView;
    }


    public function destroy($id)
    {
        //
    }
}