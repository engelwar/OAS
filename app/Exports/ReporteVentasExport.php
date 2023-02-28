<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class ReporteVentasExport implements FromArray, WithHeadings, ShouldAutoSize
{
  public function __construct(array $venta, $fini, $ffin)
  {
    $this->venta = $venta;
    $this->fini = $fini;
    $this->ffin = $ffin;
  }

  public function array(): array
  {
    return $this->venta;
  }
  public function headings(): array
  {
    return [
      [
        'REPORTE DE VENTAS',
      ],
      [
        "ENTRE " . $this->fini . " - " . $this->ffin . "",
      ],
      [
        'NTransaccion',
        'Fecha',
        'Categoria',
        'Codigo',
        'Descripcion',
        'U.M.',
        'ImpUnitario',
        'Cantidad',
        'Importe',
        'Descuento',
        'Descuento%',
        'Total',
        'NomCliente',
        'RazonSocial',
        'Nit',
        'Factura',
        'Usuario',
        'Almacen',
      ],
    ];
  }
}
