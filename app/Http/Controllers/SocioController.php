<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
class SocioController extends Controller
{
    public function show(){
        $measures = Auth::user()->measures;
        return view('socio.index')->with('measures',$measures);
    }
}
