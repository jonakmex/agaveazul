<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Domains\Shared\Boundary\RequestFactory;
use App\Domains\Shared\UseCase\UseCaseFactory;

class HomeController extends Controller
{
    private $returnView;
    private $requestFactory;
    private $findUnitsByCriteriaUseCase;

    public function __construct()
    {
        $useCaseFactory = app(UseCaseFactory::class);
        $this->requestFactory = app(RequestFactory::class);
        $this->findUnitsByCriteriaUseCase = $useCaseFactory->make('App\Domains\Condo\UseCase\FindUnitsByCriteriaUseCase');
    }

    public function index(){
        $this->returnView = view('unit.failure');
        $findUnitsByCriteriaRequest = $this->requestFactory->make("App\Domains\Condo\Boundary\Input\FindUnitsByCriteriaRequest", 
                            ["description" => '']);
        
        $this->findUnitsByCriteriaUseCase->execute($findUnitsByCriteriaRequest, function($response){
            if($response->errors) 
                $this->returnView = view('unit.failure')->with("error", $response->errors[0]["description"]);
            else
                $this->returnView = view('admin.home', ["units"=> $response->unitsDS]); 
        });

        return $this->returnView;
    }
}
