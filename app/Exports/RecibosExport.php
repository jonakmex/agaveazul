<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

use App\Reciboheader;
use App\Recibos;
class RecibosExport implements FromQuery,WithMapping,WithHeadings
{
    use Exportable;

    /**
    * @var Recibos $recibo
    */

    public function __construct(int $hdr_id)
    {
        $this->hdr_id = $hdr_id;
    }

    public function map($recibo): array
    {

      switch($recibo->estado){
        case 1:
          $edoDsc = "Pendiente";
        break;
        case 2:
          $edoDsc = "Pagado";
        break;
        case 3:
          $edoDsc = "Con Retraso";
        break;
      }
        return [
            $recibo->vivienda->descripcion,
            number_format($recibo->importe, 2, '.', ','),
            number_format($recibo->ajuste, 2, '.', ','),
            number_format($recibo->importe+$recibo->ajuste, 2, '.', ','),
            $edoDsc,
            $recibo->fecLimite,
            $recibo->fecPago
        ];
    }

    public function headings(): array
    {
        return [
            'Vivienda',
            'Importe',
            'Ajuste',
            'Total',
            'Estado',
            'Fec. Vencimiento',
            'Fec. Pago',
        ];
    }

    public function query()
    {
        $reciboHeader = Reciboheader::findOrFail($this->hdr_id);
        return $reciboHeader->recibos();
    }
}
