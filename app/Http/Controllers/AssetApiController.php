<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Domains\Shared\Boundary\RequestFactory;
use App\Domains\Shared\UseCase\UseCaseFactory;

class AssetApiController extends Controller
{
    private $responseJson;
    private $createAssetUseCase;
    private $editAssetUseCase;
    private $findAssetByIdUseCase;
    private $findAssetsByCriteriaUseCase;
    private $deleteAssetUseCase;


    public function __construct()
    {
        $useCaseFactory = app(UseCaseFactory::class);
        $this->requestFactory = app(RequestFactory::class);
        $this->createAssetUseCase = $useCaseFactory->make('App\Domains\Condo\UseCase\CreateAssetUseCase');
        $this->editAssetUseCase = $useCaseFactory->make('App\Domains\Condo\UseCase\EditAssetUseCase');
        $this->findAssetByIdUseCase = $useCaseFactory->make('App\Domains\Condo\UseCase\FindAssetByIdUseCase');
        $this->findAssetsByCriteriaUseCase = $useCaseFactory->make('App\Domains\Condo\UseCase\FindAssetsByCriteriaUseCase');
        $this->deleteAssetUseCase = $useCaseFactory->make('App\Domains\Condo\UseCase\DeleteAssetUseCase');
    }

    public function index(Request $request){
    
        $findAssetsByCriteriaRequest = $this->requestFactory->make("App\Domains\Condo\Boundary\Input\FindAssetsByCriteriaRequest", [
            "description" => $request->description, 
            "type" => $request->type,
            "unitId" => $request->unitId
        ]);
        $this->findAssetsByCriteriaUseCase->execute($findAssetsByCriteriaRequest, function($response){
            if($response->errors){
                $this->responseJson = response()->json($response->errors);
            }
            else {
                $this->responseJson = response()->json($response->assetsDS);
            }
        });

        return $this->responseJson;
    }

    public function show($id){
        $findAssetByIdRequest = $this->requestFactory->make("App\Domains\Condo\Boundary\Input\FindAssetByIdRequest",["id"=>$id]);

        $this->findAssetByIdUseCase->execute($findAssetByIdRequest,function($response){
            if($response->errors){
                $this->responseJson = response()->json($response->errors);
            }
            else {
                $this->responseJson = response()->json($response->assetDS);
            }
        });

        return $this->responseJson;
    }

    public function store(Request $request)
    {
        $createAssetRequest = $this->requestFactory->make(
            "App\Domains\Condo\Boundary\Input\CreateAssetRequest",[
            "description"=>$request->description, 
            "unitId"=>$request->unitId,
            "type"=>$request->type
        ]);
        $this->createAssetUseCase->execute($createAssetRequest,function($response){
            if($response->errors){
                $this->responseJson = response()->json($response->errors);
            }
            else {
                $this->responseJson = response()->json($response->assetDS);
            }
        });

        return $this->responseJson;
    }

    public function update(Request $request, $id){
        $editAssetRequest = $this->requestFactory->make(
            "App\Domains\Condo\Boundary\Input\EditAssetRequest", 
            ["id" => $id, "description" => $request->description, "type" => $request->type]
        );
        $this->editAssetUseCase->execute($editAssetRequest,function($response){
            if($response->errors){
                $this->responseJson = response()->json($response->errors);
            }
            else {
                $this->responseJson = response()->json($response->assetDS);
            }
        });

        return $this->responseJson;
    }

    public function destroy($id){
        $deleteAssetRequest = $this->requestFactory->make("App\Domains\Condo\Boundary\Input\DeleteAssetRequest", ["id"=> $id]);
        $this->deleteAssetUseCase->execute($deleteAssetRequest,function($response){
            if($response->errors){
                $this->responseJson = response()->json($response->errors);
            }
            else {
                $this->responseJson = response()->json($response->assetDS);
            }
        });

        return $this->responseJson;
    }
}
