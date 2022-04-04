<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Domains\Shared\Boundary\RequestFactory;
use App\Domains\Shared\UseCase\UseCaseFactory;


class ContactApiController extends Controller
{
    private $responseJson;
    private $createContactUseCase;
    private $editContactUseCase;
    private $findContactByIdUseCase;
    private $findContactsByCriteriaUseCase;
    private $deleteContactUseCase;
   

    public function __construct()
    {
        $useCaseFactory = app(UseCaseFactory::class);
        $this->requestFactory = app(RequestFactory::class);
        $this->createContactUseCase = $useCaseFactory->make('App\Domains\Condo\UseCase\CreateContactUseCase');
        $this->editContactUseCase = $useCaseFactory->make('App\Domains\Condo\UseCase\EditContactUseCase');
        $this->findContactByIdUseCase = $useCaseFactory->make('App\Domains\Condo\UseCase\FindContactByIdUseCase');
        $this->findContactsByCriteriaUseCase = $useCaseFactory->make('App\Domains\Condo\UseCase\FindContactsByCriteriaUseCase');
        $this->deleteContactUseCase = $useCaseFactory->make('App\Domains\Condo\UseCase\deleteContactUseCase');
    }

    public function index(Request $request)
    {
        $findContactsByCriteriaRequest =  $this->requestFactory->make(
            "App\Domains\Condo\Boundary\Input\FindContactsByCriteriaRequest", [
            "name" => $request->name, 
            "lastName" => $request->lastName, 
            "unit_id"=>$request->unit_id, 
            "type"=>$request->type
        ]);
        $this->findContactsByCriteriaUseCase->execute($findContactsByCriteriaRequest, function($response){
            if($response->errors != null && count($response->errors) > 0){
                $this->responseJson = response()->json($response->errors);
            }
            else {
                $this->responseJson = response()->json($response->contactsDS);
            }
        });
        return $this->responseJson;
    }

    public function store(Request $request)
    {
        $createContactRequest = $this->requestFactory->make( 
            "App\Domains\Condo\Boundary\Input\CreateContactRequest",[
            "name"=>$request->name, 
            "lastName"=>$request->lastName, 
            "type"=>$request->type,
            "unit_id"=> $request->unit_id]);
        $this->createContactUseCase->execute($createContactRequest,function($response) {
            if($response->errors != null && count($response->errors) > 0){
                $this->responseJson = response()->json($response->errors);
            }
            else {
                $this->responseJson = response()->json($response->contactDS);
            }
        });
        return $this->responseJson;
    }

    public function show($id)
    {
        $findContactByIdRequest = $this->requestFactory->make( 
            "App\Domains\Condo\Boundary\Input\FindAssetByIdRequest", 
            ["id"=>$id] );
        $this->findContactByIdUseCase->execute($findContactByIdRequest,function($response) {
            if($response->errors != null && count($response->errors) > 0){
                $this->responseJson = response()->json($response->errors);
            }
            else {
                $this->responseJson = response()->json($response->contactDS);
            }
        });
        return $this->responseJson;
    }


    public function update(Request $request, $id)
    {
        $editContactRequest = $this->requestFactory->make( "App\Domains\Condo\Boundary\Input\EditContactRequest",[
            "name"=>$request->name, 
            "lastName"=>$request->lastName, 
            "type"=>$request->type, 
            "id"=>$id]
        );
        $this->editContactUseCase->execute($editContactRequest,function($response){
            if($response->errors != null && count($response->errors) > 0){
                $this->responseJson = response()->json($response->errors);
            }
            else {
                $this->responseJson = response()->json($response->contactDS);
            }
        });
        return $this->responseJson;
    }


    public function destroy($id)
    {
        $deleteContactRequest = $this->requestFactory->make(
            "App\Domains\Condo\Boundary\Input\DeleteContactRequest",[
                "id"=> $id]);
        
        $this->deleteContactUseCase->execute($deleteContactRequest,function($response){
            if($response->errors != null && count($response->errors) > 0){
                $this->responseJson = response()->json($response->errors);
            }
            else {
                $this->responseJson = response()->json($response->contactDS);
            }
        });
        return $this->responseJson;
    }
}