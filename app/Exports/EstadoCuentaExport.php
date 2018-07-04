<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Cuenta;
use App\Cuentamovimiento;
use \Datetime;

class EstadoCuentaExport implements FromQuery,WithMapping,WithHeadings
{
    use Exportable;

    /**
    * @var Cuentamovimiento $movimiento
    */

    public function __construct(int $cta_id,$fecIni, $fecFin)
    {
        DateTime::createFromFormat( 'Y-m-d', $fecIni);
        $this->cta_id = $cta_id;
        $this->fecIni = DateTime::createFromFormat( 'Y-m-d', $fecIni);
        $this->fecFin = DateTime::createFromFormat( 'Y-m-d', $fecFin);
    }

    public function map($movimiento): array
    {
        return [
            $movimiento->descripcion,
            number_format($movimiento->ingreso, 2, '.', ','),
            number_format($movimiento->egreso, 2, '.', ','),
            number_format($movimiento->saldo, 2, '.', ','),
            $movimiento->fecMov,
        ];
    }

    public function headings(): array
    {
        return [
            'Descripcion',
            'Ingreso',
            'Egreso',
            'Saldo',
            'Fecha',
        ];
    }

    public function query()
    {
        $cuenta = Cuenta::findOrFail($this->cta_id);
        $movimientos = Cuentamovimiento::where('cuenta_id',$cuenta->id)->where('fecMov','>=',$this->fecIni)->where('fecMov','<=',$this->fecFin)->orderBy('fecMov','desc')->orderBy('id','desc');
        return $movimientos;
    }
}
