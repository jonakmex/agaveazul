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
        $this->createUnitUseCase = $useCaseFactory->make('CreateUnitUseCase');
        $this->editUnitUseCase = $useCaseFactory->make('EditUnitUseCase');
        $this->findUnitByIdUseCase = $useCaseFactory->make('FindUnitByIdUseCase');
        $this->findUnitsByCriteriaUseCase = $useCaseFactory->make('FindUnitsByCriteriaUseCase');
    }

    public function store(Request $request)
    {
        $this->returnView = "";
        $createUnitRequest = RequestFactory::make("CreateUnitRequest",["description"=>$request->description]);

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
        $findUnitByIdRequest = RequestFactory::make("FindUnitByIdRequest",["id"=>$id]);

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
        $editUnitRequest = RequestFactory::make(
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
    
        $findUnitsByCriteriaRequest = RequestFactory::make("FindUnitsByCriteriaRequest", ["description" => $request->input('description')]);
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
        $deleteUnitRequest = RequestFactory::make("DeleteUnitRequest", ["id"=> $id]);
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
