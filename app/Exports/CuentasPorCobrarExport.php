<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class CuentasPorCobrarExport implements FromArray, WithHeadings,ShouldAutoSize
{
    public function __construct(array $resum, $fecha1, $fecha2)
    {
        $this->resum = $resum;
        $this->fecha1 = $fecha1;
        $this->fecha2 = $fecha2;
    }

    public function array(): array
    {
        return $this->resum;
    }
    public function headings(): array
    {
        return [
        [
            'REPORTE DE CUENTAS POR COBRAR',
        ],
        [
            "Entre el ".$this->fecha1." - ".$this->fecha2."",
        ],
        [
            'Codigo',
            'Cliente',
            'RazonSocial',
            'Nit',
            'Fecha',
            'FechaVenc',
            'ImporteCXC',
            'ACuenta',
            'FechaCobro',
            'Saldo',
            'Glosa',
            'Usuario',
            'M.',
            'Venta',
            'Num. Fac',
            'Local',
            'estado',
        ],
        ];
    }
}
