<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Domains\Shared\Boundary\RequestFactory;
use App\Domains\Shared\UseCase\UseCaseFactory;

class AssetWebController extends Controller
{
    private $returnView;
    private $requestFactory;
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
        $this->findAssetByIdUseCase = $useCaseFactory->make('App\Domains\Condo\UseCase\FindAssetByIdUseCase');
        $this->findAssetsByCriteriaUseCase = $useCaseFactory->make('App\Domains\Condo\UseCase\FindAssetsByCriteriaUseCase');
        $this->deleteAssetUseCase = $useCaseFactory->make('App\Domains\Condo\UseCase\DeleteAssetUseCase');
    }

    public function index(Request $request)
    {
        $findAssetsByCriteriaRequest = $this->requestFactory->make(
            "App\Domains\Condo\Boundary\Input\FindAssetsByCriteriaRequest", [
                "description"=>$request->description,
                "type"=>$request->type,
                "unitId"=>$request->unitId
        ]);
        $this->findAssetsByCriteriaUseCase->execute($findAssetsByCriteriaRequest, function($response) use($request){
            if(property_exists($response, 'assetsDS'))
                $this->returnView = view('asset.index', ["assets"=>$response->assetsDS, "unitId"=>$request->unitId]);
            else 
                $this->returnView = view('asset.failure', ["errors"=>$response->errors[0]]);
        });

        return $this->returnView;
    }

    public function create(Request $request)
    {
        return view('asset.create',["unitId"=>$request->unitId]);
    }

    public function store(Request $request)
    {
        $this->returnView = view('asset.failure');
        $createAssetRequest = $this->requestFactory->make(
            "App\Domains\Condo\Boundary\Input\CreateAssetRequest",[
            "description"=>$request->description, 
            "unitId"=>$request->unitId,
            "type"=>$request->type
        ]);
        $this->createAssetUseCase->execute($createAssetRequest,function($response){
            if(property_exists($response, 'assetDS'))
                $this->returnView = redirect()->route('unit.show',[$response->assetDS->unitId]);
            else 
                $this->returnView = view('asset.failure',['errors'=>$response->errors]);
        });

        return $this->returnView;
    }

    public function show($id)
    {
        $this->returnView = view('asset.failure');
        $findAssetByIdRequest = $this->requestFactory->make(
            "App\Domains\Condo\Boundary\Input\FindAssetByIdRequest", ["id"=>$id]);
        $this->findAssetByIdUseCase->execute($findAssetByIdRequest, function($response){
            $this->returnView = view('asset.show', ["asset"=> $response->assetDS]);
        });
        return $this->returnView;
    }

    public function edit($id)
    {
        $this->returnView = view('asset.failure');
        $findAssetByIdRequest = $this->requestFactory->make(
            "App\Domains\Condo\Boundary\Input\FindAssetByIdRequest", ["id"=>$id]);
        $this->findAssetByIdUseCase->execute($findAssetByIdRequest, function($response){
            $this->returnView = view('asset.edit', ["asset"=> $response->assetDS]);
        });
        return $this->returnView;
    }

    public function update(Request $request, $id)
    {
        $this->returnView = view('asset.failure');
        $editAssetRequest = $this->requestFactory->make(
            "App\Domains\Condo\Boundary\Input\EditAssetRequest", ["id"=>$id, "description"=> $request->description, "type"=>$request->type]
        );
        $this->editAssetUseCase->execute($editAssetRequest, function($response){
            $this->returnView = view('asset.show', ["asset"=> $response->assetDS]);
        });
        return $this->returnView;
    }

    public function destroy($id)
    {
        $this->returnView = view('asset.failure');
        $deleteAssetRequest = $this->requestFactory->make(
            "App\Domains\Condo\Boundary\Input\DeleteAssetRequest",["id"=>$id]);
        $this->deleteAssetUseCase->execute($deleteAssetRequest, function($response){
            $this->returnView = redirect()->route('asset.index')->with('success','unit succesfully removed');
        });
        return $this->returnView;
    }
}
