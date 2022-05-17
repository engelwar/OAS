<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class KardexReport implements FromArray, WithHeadings
{
  /**
   * @return \Illuminate\Support\Collection
   */
  public function __construct(array $array)
  {
    $this->array = $array;
    //return dd($pvp);
  }
  public function array(): array
  {
    return $this->array;
  }
  public function headings(): array
  {
    return [
      [
        '_Cpro',
        'ProdDesc',
        'NroTrans',
        'Fecha',
        'Cant',
        'P.U.',
        'P.T.',
        'Cant',
        'P.U.',
        'P.T.',
        'Cant',
        'P.U.',
        'P.T.',
        'Cant Acum',
        'Cost Prom',
        'Costo Val',
        'Costo Acum',
        'Dif',
        'Trans Ini',
        'Tipo de Mov',
      ],
    ];
  }
}
