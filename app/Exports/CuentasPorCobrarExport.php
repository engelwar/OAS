<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class CuentasPorCobrarExport implements FromArray, WithHeadings,ShouldAutoSize
{
    public function __construct(array $resum, $fecha)
    {
        $this->resum = $resum;
        $this->fecha = $fecha;
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
            "AL ".$this->fecha."",
        ],
        [
            'Codigo',
            'Cliente',
            'Fecha',
            'FechaVenc',
            'ImporteCXC',
            'ACuenta',
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
