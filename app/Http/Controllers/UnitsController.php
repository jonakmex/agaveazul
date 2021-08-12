<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UnitsController extends Controller
{
    function index(){
        return view('profiles.admin.units.index');
    }
}
