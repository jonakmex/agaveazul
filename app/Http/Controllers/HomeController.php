<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->profile->id == 1){
            return view('admin.home');
        } else if(Auth::user()->profile->id == 2)
        {
            return view('tesorero.home');
        }else{
            return view('condomino.home');
        }
        
    }
}
