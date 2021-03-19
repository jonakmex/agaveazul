<?php
namespace App\DS\Request\Vivienda;
use App\DS\Request;

class ActualizarViviendaRequest extends Request
{
    public $id;
    public $descripcion;
    public $clave;
    public $referencia;
}