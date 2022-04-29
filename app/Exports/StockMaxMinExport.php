<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class StockMaxMinExport implements FromArray, WithHeadings,ShouldAutoSize
{
    public function __construct(array $textMax, $textMin, $titulos_excel)
    {
      $this->textMax = $textMax;
      $this->textMin = $textMin;
      $this->titulos = $titulos_excel;
    }

    public function array(): array
    {
        return $this->textMax;
    }
    public function headings(): array
    {
        return [
        [
            'Categoria',
            'Codigo',
            'Descripcion',
            'Umprod',
            'Maxpro',
            'Minpro',
            'AC2',
            'Planta',
        ],
        ];
    }
}
