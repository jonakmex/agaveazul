<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\StaffService;
use App\Service\Mapper\StaffMapper;
use App\Exception\BusinessException;
use Illuminate\Support\Facades\Auth;
use App\Staff;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Auth::user()->authorizeRoles(['Administrador']);
        $staff = Staff::where('estado',1)->paginate(5);
        return view('profiles.admin.staff.index')->with('staff',$staff);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      // validate form data
      Auth::user()->authorizeRoles(['Administrador']);

      $this->validate($request,[
          'nombre' => 'required|min:1|max:30',
          'apellido' => 'required|min:1|max:30',
          'email' => 'required|email|min:1|max:100'
      ]);
      
      $staff = Staff::find($request->id);
      if($staff === null){
          $staff = new Staff();
          $staff->estado = 1;
      }
      StaffMapper::map($staff,$request);

      try{
        StaffService::save($staff);
        return redirect()->route('staff.index');
      }
      catch(BusinessException $e){
        return redirect()->route('staff.index');
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
      Auth::user()->authorizeRoles(['Administrador']);
      $staff = Staff::findOrFail($id);
      $staff->estado = 0;
      if($staff->save()){
          return redirect()->route('staff.index');
      }
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
      Auth::user()->authorizeRoles(['Administrador']);
      // validate form data
      $this->validate($request,[
        'nombre' => 'required|min:1|max:30',
        'apellido' => 'required|min:1|max:30',
        'email' => 'required|email|min:1|max:100'
      ]);
      //Process de data and submit it
      $staff = Staff::findOrFail($id);
      StaffMapper::map($staff,$request);
      
      StaffService::save($staff);
      return redirect()->route('staff.index');
      
    }

    public function generarToken(Request $request)
    {
      Auth::user()->authorizeRoles(['Administrador']);
      $staff = Staff::findOrFail($request->id);
      StaffService::crearTokenRegistro($staff);
      return redirect()->route('staff.index');
    }
}
