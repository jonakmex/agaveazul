<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
use File;
use App\Recibos;
use App\Cuenta;
use App\Cuentamovimiento;
use \Datetime;
use App\AvisoMail;
use App\DTO\PagarReciboIn;
use App\DTO\EditarReciboIn;
use App\Service\Mapper\ReciboMapper;
use App\Service\ReciboService;
use App\Log;
use Illuminate\Support\Facades\Auth;

class PagosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        //return view('admin.pagos.create');
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
      $this->validate($request,[
        //'importe' => 'required|numeric',
        'ajuste' => 'required|numeric',
        'fecPago' => 'required|date',
        'timeIngreso' => 'required',
        'rec_id' => 'required',
        'cuenta_id' => 'required',
        'tipo_pago' => 'required',
        'comprobante' => 'mimes:jpg,bmp,png,pdf,zip',
      ]);

      $pagarReciboIn = ReciboMapper::getPagarReciboIn($request);
      ReciboService::pagar($pagarReciboIn);
      switch($request->origen){
        case 'recibos':
          return redirect()->route('recibosHeader.show',['id' => $request->_id]);
        break;
        default:
        return redirect()->route('vivienda.show',['id' => $request->_id]);
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
      Auth::user()->authorizeRoles(['Administrador']);
        return view('admin.pagos.edit');
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
        //'importe' => 'required|numeric',
        'ajuste' => 'required|numeric',
        'fecPago' => 'required|date',
        'timeIngreso' => 'required',
        'rec_id' => 'required',
        'cuenta_id' => 'required',
        'tipo_pago' => 'required',
        'comprobante' => 'Image',
      ]);

      $editarReciboIn = ReciboMapper::getEditarReciboIn($request);
      ReciboService::editar($editarReciboIn);
      return redirect()->back();
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

    public function pdf()
    {
      Auth::user()->authorizeRoles(['Administrador']);
      $pdf = PDF::loadView('table');
      return $pdf->download('invoice.pdf');
    }
}
