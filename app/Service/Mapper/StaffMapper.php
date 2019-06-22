<?php
namespace App\Service\Mapper;
use Illuminate\Http\Request;
use App\Staff;

class StaffMapper
{
  public static function map(Staff $staff,Request $request)
  {
    $staff->nombre = $request->nombre;
    $staff->apellido = $request->apellido;
    $staff->email = $request->email;
  }
}
