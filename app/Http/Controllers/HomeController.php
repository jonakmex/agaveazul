<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request){
      if($request->user()->profile->descripcion === 'Administrador'){
        return view('home');
      }
      else if($request->user()->profile->descripcion === 'Residente'){
        return redirect()->route('vivienda.show', ['id' => $request->user()->residente->vivienda->id]);
      }
      else if($request->user()->profile->descripcion === 'Operador'){
        return view('profiles.operador.home');
      }
    }
}
