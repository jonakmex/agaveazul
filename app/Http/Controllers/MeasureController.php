<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Measure;
use App\User;

class MeasureController extends Controller
{
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('socio.measure.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'user_id' => "required|integer",
            'weight' => "required",
            'fat' => "required",
            'muscle' => "required",
            'visceral' => "required",
            'bmi' => "required",
            'kcalbase' => "required",
            'age' => "required",
            'dom' => "required"
        ]);
        
        $user = User::findOrFail($request->user_id);
        
        $measure = new Measure();
        $measure->weight = str_replace("_", "", $request->weight);
        $measure->fat = str_replace("_", "", $request->fat);
        $measure->muscle = str_replace("_", "", $request->muscle);
        $measure->visceral = str_replace("_", "", $request->visceral);
        $measure->bmi = str_replace("_", "", $request->bmi);
        $measure->kcalbase = str_replace("_", "", $request->kcalbase);
        $measure->age = str_replace("_", "", $request->age);
        $measure->dom = str_replace("_", "", $request->dom);
        
        if($user->measures()->save($measure)){
            return redirect()->route('socio.main');
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Use the model to get one record from DB
        $measure = Measure::findOrFail($id);
        //Show the view and pass the record
        return view('socio.measure.edit')->with('measure',$measure);
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
        $this->validate($request,[
            'weight' => "required",
            'fat' => "required",
            'muscle' => "required",
            'visceral' => "required",
            'bmi' => "required",
            'kcalbase' => "required",
            'age' => "required",
            'dom' => "required"
        ]);
        
        $measure = Measure::findOrFail($id);
        
        $measure->weight = str_replace("_", "", $request->weight);
        $measure->fat = str_replace("_", "", $request->fat);
        $measure->muscle = str_replace("_", "", $request->muscle);
        $measure->visceral = str_replace("_", "", $request->visceral);
        $measure->bmi = str_replace("_", "", $request->bmi);
        $measure->kcalbase = str_replace("_", "", $request->kcalbase);
        $measure->age = str_replace("_", "", $request->age);
        $measure->dom = str_replace("_", "", $request->dom);
        
        if($measure->save()){
            return redirect()->route('socio.main');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Measure::destroy($id);
        return redirect()->route('socio.main');
    }
}
