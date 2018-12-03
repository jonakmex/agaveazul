<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\EstadoCuentaExport;
use App\Cuenta;
use App\Cuentamovimiento;
use Illuminate\Support\Facades\Auth;

class CuentasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      Auth::user()->authorizeRoles(['Administrador','Residente']);
      $cuentas = Cuenta::where('estado',1)->paginate(10);
      if(Auth::user()->profile->descripcion ==='Administrador'){
        return view('cuentas.index')->with('cuentas',$cuentas);
      }
      else if(Auth::user()->profile->descripcion ==='Residente'){
        return view('profiles.residente.finanzas.index')->with('cuentas',$cuentas);
      }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      Auth::user()->authorizeRoles(['Administrador']);
        return view('cuentas.create');
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
      // validate form data
      $this->validate($request,[
          'descripcion' => 'required|min:3|max:30'
      ]);
      //Process de data and submit it
      $cuenta = new Cuenta();

      $cuenta->descripcion = $request->descripcion;
      $cuenta->saldo = $request->saldo == null ? 0 : $request->saldo;
      $cuenta->estado = 1;
      //Redirect if successfull
      if($cuenta->save()){
          return redirect()->route('cuentas.show',['id' => $cuenta->id]);
      }
      else{
          return redirect()->route('cuentas.create');
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
      Auth::user()->authorizeRoles(['Administrador','Residente']);
        $cuenta = Cuenta::findOrFail($id);
        $cuentas = Cuenta::where('estado',1)->get();
        $movimientos = Cuentamovimiento::where('cuenta_id',$cuenta->id)->orderBy('fecMov','desc')->orderBy('id','desc')->paginate(5);


        if(Auth::user()->profile->descripcion ==='Administrador'){
          return view('cuentas.show')->with(['selected'=>$cuenta,'cuentas'=>$cuentas,'movimientos'=>$movimientos] );
        }
        else if(Auth::user()->profile->descripcion ==='Residente'){
          return view('profiles.residente.finanzas.show')->with(['selected'=>$cuenta,'cuentas'=>$cuentas,'movimientos'=>$movimientos] );
        }

    }

    public function exportar(Request $request)
    {
      Auth::user()->authorizeRoles(['Administrador']);
      // validate form data
      $this->validate($request,[
          'fecInicio' => 'required',
          'fecFin' => 'required'
      ]);
      $cuenta = Cuenta::findOrFail($request->id);
      $name = $cuenta->descripcion;
      return (new EstadoCuentaExport($request->id,$request->fecInicio,$request->fecFin))->download("$name.xlsx");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      Auth::user()->authorizeRoles(['Administrador']);
        $cuenta = Cuenta::findOrFail($id);
        return view('cuentas.edit')->with('cuenta',$cuenta);
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
      $this->validate($request,[
          'descripcion' => 'required|min:3|max:30'
      ]);

      $cuenta = Cuenta::findOrFail($id);
      $cuenta->descripcion = $request->descripcion;

      //Redirect if successfull
      if($cuenta->save()){
          return redirect()->route('cuentas.show',['id' => $cuenta->id]);
      }
      else{
          return redirect()->route('cuentas.create');
      }
      return redirect()->route('cuentas.show',['id' => $cuenta->id]);
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
        $cuenta = Cuenta::findOrFail($id);
        $cuenta->estado = 0;
        if($cuenta->save()){
            return redirect()->route('cuentas.index');
        }

    }
}
