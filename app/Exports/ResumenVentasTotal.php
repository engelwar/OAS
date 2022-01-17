<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ResumenVentasTotal implements FromArray, WithHeadings,ShouldAutoSize
{
    public function __construct(array $resum, $fini, $ffin)
    {
        $this->resum = $resum;
        $this->fini = $fini;
        $this->ffin = $ffin;
    }

    public function array(): array
    {
        return $this->resum;
    }
    public function headings(): array
    {
        return [
        [
            'REPORTE DE VENTAS',
        ],
        [
            "DEL ".$this->fini." AL ".$this->ffin."",
        ],
        [
            'Local',
            'Guupo',
            'Total',
            'Moneda',
            'Efectivo',
            'Banco',
            'CXC',
            'Tarjeta',
            'Mot. Contable',
            'Otros',
        ]
        ];
    }
}
