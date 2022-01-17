<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ComprasLocMovExport implements FromArray, WithHeadings
{
    public function __construct(array $test)
    {
        $this->test = $test;
    }

    public function array(): array
    {
        return $this->test;
    }
    public function headings(): array
    {
        return [
            'Categoria',
            'Codigo',
            'Descripcion',
            'U.M.',
            'Precio Orig',
            'M. Precio O',
            'Costo Ult. Compra/Importacion',
            'M. Costo Ult. C/I',
            'Tipo Compra',
            'PVP',
            'Fecha Ult. C/I',
            'Cantidad Ult.',
            'U.M. Ult. C/I',
            'Transaccion Ini.',
            'Proveedor',
            'Stock Total',
            'AC2',
            'AC1',
            'Planta El Alto',
            'Handal',
            'Ballivian',
            'Msal',
            'Calacoto',
            'Santa Cruz',
            'Fecha Ult. Venta',
        ];
    }
}
