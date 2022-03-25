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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('unit.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $unitRepository = new UnitEloquentRepository();
         return view('unit.edit', ["unit"=>$unitRepository->findById($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $EditUnitRequest = RequestFactory::make("EditUnitRequest",["description"=>$request->getDescription(), "id"=> $id]);

 
 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
