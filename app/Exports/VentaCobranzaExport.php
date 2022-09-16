<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class VentaCobranzaExport implements FromArray, WithHeadings, ShouldAutoSize
{
  public function __construct(array $resumen, $fini, $ffin)
  {
    $this->resumen = $resumen;
    $this->fini = $fini;
    $this->ffin = $ffin;
  }

  public function array(): array
  {
    return $this->resumen;
  }
  public function headings(): array
  {
    return [
      [
        'VENTAS Y COBRANZAS',
      ],
      [
        "DEL " . $this->fini . " AL " . $this->ffin . "",
      ],
      [
        "",
        "",
        "",
        "SALDO CxC",
        "VENTAS",
        "",
        "",
        "COBRANZAS"
      ],
      [
        'IdUsuario',
        'Local',
        'Usuario',
        'SaldoAnterior',
        'Contado',
        'Credito',
        'Total',
        'Vigente',
        'Vencido',
        'Mora',
        'Total',
        'SaldoActual',
      ]
    ];
  }
}
