<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Domains\Shared\Boundary\RequestFactory;
use App\Domains\Shared\UseCase\UseCaseFactory;

class UnitApiController extends Controller
{
    private $responseJson;
    private $createUnitUseCase;
    private $editUnitUseCase;
    private $findUnitByIdUseCase;
    private $findUnitsByCriteriaUseCase;


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

    public function store(Request $request)
    {
        $this->returnView = "";
        $createUnitRequest = $this->requestFactory->make("App\Domains\Condo\Boundary\Input\CreateUnitRequest",["description"=>$request->description]);

        $this->createUnitUseCase->execute($createUnitRequest,function($response){
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
        $findUnitByIdRequest = $this->requestFactory->make("App\Domains\Condo\Boundary\Input\FindUnitByIdRequest",["id"=>$id]);

        $this->findUnitByIdRequest->execute($findUnitByIdRequest,function($response){
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
        $editUnitRequest = $this->requestFactory->make(
            "EditUnitRequest",["description" => $request->description, "id"=>$id]
        );

        $this->editUnitUseCase->execute($editUnitRequest,function($response){
            if($response->errors != null && count($response->errors) > 0){
                $this->responseJson = response()->json($response->errors);
            }
            else {
                $this->responseJson = response()->json($response->unitDS);
            }
        });

        return $this->responseJson;
    }

    public function index(Request $request){
    
        $findUnitsByCriteriaRequest = $this->requestFactory->make("App\Domains\Condo\Boundary\Input\FindUnitsByCriteriaRequest", ["description" => $request->input('description')]);
        $this->findUnitsByCriteriaUseCase->execute($findUnitsByCriteriaRequest, function($response){
            if($response->errors != null && count($response->errors) > 0){
                $this->responseJson = response()->json($response->errors);
            }
            else {
                $this->responseJson = response()->json($response->unitsDS);
            }
        });

        return $this->responseJson;
    }

    public function destroy($id){
        $deleteUnitRequest = $this->requestFactory->make("App\Domains\Condo\Boundary\Input\DeleteUnitRequest", ["id"=> $id]);
        $this->deleteUnitUseCase->execute($deleteUnitRequest,function($response){
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
