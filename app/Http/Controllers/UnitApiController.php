<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Domains\Shared\Boundary\RequestFactory;
use App\Domains\Shared\UseCase\UseCaseFactory;
use App\Domains\Condo\Repository\UnitEloquentRepository;

class UnitApiController extends Controller
{
    private $responseJson;

    public function store(Request $request)
    {
        $this->returnView = "";
        $createUnitRequest = RequestFactory::make("CreateUnitRequest",["description"=>$request->description]);
        $dependencies = ["unitRepository"=>new UnitEloquentRepository()];
        $useCase = UseCaseFactory::make("CreateUnitUseCase",$dependencies);
        $useCase->execute($createUnitRequest,function($response){
            if($response->errors != null && count($response->errors) > 0){
                $this->responseJson = response()->json($response->errors);
            }
            else {
                $this->responseJson = response()->json($response->unitDS);
            }
        });

        return $this->responseJson;
    }

    public function show($id){
        $findUnitByIdRequest = RequestFactory::make("FindUnitByIdRequest",["id"=>$id]);
        $dependencies = ["unitRepository"=>new UnitEloquentRepository()];
        $useCase = UseCaseFactory::make("FindUnitByIdUseCase",$dependencies);
        $useCase->execute($findUnitByIdRequest,function($response){
            if($response->errors != null && count($response->errors) > 0){
                $this->responseJson = response()->json($response->errors);
            }
            else {
                $this->responseJson = response()->json($response->unitDS);
            }
        });

        return $this->responseJson;
    }

    public function update(Request $request, $id){
        $editUnitRequest = RequestFactory::make(
            "EditUnitRequest",["description" => $request->description, "id"=>$id]
        );
        $dependencies = ["unitRepository"=>new UnitEloquentRepository()];
        $useCase = UseCaseFactory::make("EditUnitUseCase",$dependencies);
        $useCase->execute($editUnitRequest,function($response){
            if($response->errors != null && count($response->errors) > 0){
                $this->responseJson = response()->json($response->errors);
            }
            else {
                $this->responseJson = response()->json($response->unitDS);
            }
        });

        return $this->responseJson;
    }
}
