<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Config;

class ConfigController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Auth::user()->authorizeRoles(['Administrador']);
        $config = Config::get();
        $items = array();
        foreach($config as $item){
            $checked = $item->value == '1' ? 'checked' : '';
            array_push($items,['checked'=>$checked,'key'=>$item->key]);
        }
        return view('profiles.admin.config.index')->with('items',$items);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Auth::user()->authorizeRoles(['Administrador']);
        $itemsEnabled = is_array($request->enabled)  ? $request->enabled : array();
        $items = Config::get();
        
        foreach($items as $item){
            info($item['key']);
            $config = Config::where('key',$item['key'])->first();
            if($config->value == '1' && !in_array($item['key'],$itemsEnabled) ){
                $config->value = '0';
            }
            elseif ($config->value == '0' && in_array($item['key'],$itemsEnabled)){
                $config->value = '1';
            }
            $config->save();
        }
        
        return redirect()->route('config.index');
    }
}
