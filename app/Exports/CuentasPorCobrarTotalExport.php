<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class CuentasPorCobrarTotalExport implements FromArray, WithHeadings,ShouldAutoSize
{
    public function __construct(array $sql_excel, $fecha)
    {
      $this->sql_excel = $sql_excel;
      $this->fecha = $fecha;
    }

    public function array(): array
    {
        return $this->sql_excel;
    }
    public function headings(): array
    {
      $titulo = "Al ".$this->fecha;
        return [
        [
            'REPORTE DE CUENTAS POR COBRAR TOTAL',
        ],
        [
            $titulo,
        ],
        [
            'FechaNR',
            'NR',
            'Cliente',
            'FechaFac',
            'NroFac',
            'Glosa',
            'RazonSocial',
            'NIT',
            'ImpTotal',
            'FechaACuenta',
            'Contado',
            'Credito',
            'Usuario',
        ],
        ];
    }
}
