<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use PhpParser\Node\Stmt\Foreach_;

class PruebaController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return view('reports.resumenxmes');
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $segmento = [
      ['name' => 'BALLIVIAN', 'abrv' => 'BALLIVIAN', 'users' => [22, 41, 49, 46, 61]],
      ['name' => 'HANDAL', 'abrv' => 'HANDAL', 'users' => [26, 42, 50, 28]],
      ['name' => 'MARISCAL', 'abrv' => 'MARISCAL', 'users' => [38, 44, 51, 37]],
      ['name' => 'CALACOTO', 'abrv' => 'CALACOTO', 'users' => [32, 43, 52, 29, 57,74]],
      ['name' => 'INSTITUCIONALES', 'abrv' => 'INSTITUCIONALES', 'users' => [16, 17,62,56,3,58,4]],
      ['name' => 'MAYORISTAS', 'abrv' => 'MAYORISTAS', 'users' => [18, 19, 55, 21,20]],
      ['name' => 'SANTA CRUZ', 'abrv' => 'SANTA CRUZ', 'users' => [40, 39]],
    ];
    $regional = [
      ['name' => 'REGIONAL1', 'abrv' => 'REGIONAL1', 'usr' => [63]],
      ['name' => 'REGIONAL2', 'abrv' => 'REGIONAL2', 'usr' => [64]],
    ];
    $almacen_reg = [
      ['name' => 'REGIONAL1', 'abrv' => 'REGIONAL1', 'alm' => [57, 58]],
      ['name' => 'REGIONAL2', 'abrv' => 'REGIONAL2', 'alm' => [59, 60, 61]],
    ];
    $general = [22, 41, 49, 46, 26, 42, 50, 28, 38, 44, 51, 37, 32, 43, 52, 29, 57, 16, 17, 18, 19, 55, 21, 40, 39,62,74,20,56,3,58,4, 61,63,64];

    // $fini = date("d/m/Y", strtotime($request->fini));
    // $ffin = date("d/m/Y", strtotime($request->ffin));
    // $ff1 = $ffin;
    // // $fdia=date("d", strtotime($request->fhoy));
    // $fmes = date("d/m/Y", strtotime($request->fhoy));
    $group_mes_sum = [];
    $group_mes = [];
    $group_sum_tot = [];
    $options = $request->options;
    if (isset($request->options)) {
      foreach ($request->options as $key => $value) {
        $group_mes_sum[] = "CONVERT(varchar, CAST(ISNULL(SUM([".$value."1]),0) AS MONEY),1) AS [".$value."1],
        CONVERT(varchar, CAST(ISNULL(SUM([".$value."2]),0) AS MONEY),1) AS [".$value."2],";
        $group_mes[] = "CONVERT(varchar, CAST(ISNULL([".$value."1],0) AS MONEY),1) AS [".$value."1],
        CONVERT(varchar, CAST(ISNULL([".$value."2],0) AS MONEY),1) AS [".$value."2],";
        if ($key == 0) {
          if ($value == 'Enero') {
            $group_sum_tot[] = "ISNULL([1],0)";
          } elseif ($value == 'Febrero') {
            $group_sum_tot[] = "ISNULL([2],0)";
          } elseif ($value == 'Marzo') {
            $group_sum_tot[] = "ISNULL([3],0)";
          } elseif ($value == 'Abril') {
            $group_sum_tot[] = "ISNULL([4],0)";
          } elseif ($value == 'Mayo') {
            $group_sum_tot[] = "ISNULL([5],0)";
          } elseif ($value == 'Junio') {
            $group_sum_tot[] = "ISNULL([6],0)";
          } elseif ($value == 'Julio') {
            $group_sum_tot[] = "ISNULL([7],0)";
          } elseif ($value == 'Agosto') {
            $group_sum_tot[] = "ISNULL([8],0)";
          } elseif ($value == 'Septiembre') {
            $group_sum_tot[] = "ISNULL([9],0)";
          } elseif ($value == 'Octubre') {
            $group_sum_tot[] = "ISNULL([10],0)";
          } elseif ($value == 'Noviembre') {
            $group_sum_tot[] = "ISNULL([11],0)";
          } elseif ($value == 'Diciembre') {
            $group_sum_tot[] = "ISNULL([12],0)";
          }
        } else {
          if ($value == 'Enero') {
            $group_sum_tot[] = " + ISNULL([1],0)";
          } elseif ($value == 'Febrero') {
            $group_sum_tot[] = " + ISNULL([2],0)";
          } elseif ($value == 'Marzo') {
            $group_sum_tot[] = " + ISNULL([3],0)";
          } elseif ($value == 'Abril') {
            $group_sum_tot[] = " + ISNULL([4],0)";
          } elseif ($value == 'Mayo') {
            $group_sum_tot[] = " + ISNULL([5],0)";
          } elseif ($value == 'Junio') {
            $group_sum_tot[] = " + ISNULL([6],0)";
          } elseif ($value == 'Julio') {
            $group_sum_tot[] = " + ISNULL([7],0)";
          } elseif ($value == 'Agosto') {
            $group_sum_tot[] = " + ISNULL([8],0)";
          } elseif ($value == 'Septiembre') {
            $group_sum_tot[] = " + ISNULL([9],0)";
          } elseif ($value == 'Octubre') {
            $group_sum_tot[] = " + ISNULL([10],0)";
          } elseif ($value == 'Noviembre') {
            $group_sum_tot[] = " + ISNULL([11],0)";
          } elseif ($value == 'Diciembre') {
            $group_sum_tot[] = " + ISNULL([12],0)";
          }
        }
      }
    } else {
      dd('No Selecciono Ningun Mes');
    }
    // dd(implode($group_sum_tot));

    foreach ($general as $key) {
      $usr_general = "adusrCusr IN (" . implode(",", $general) . ")";
    }
    $query_general = "
    SELECT 
      ".implode($group_mes_sum)."
      CONVERT(varchar, CAST(ISNULL(SUM([Tot1]),0) AS MONEY),1) AS [Tot1],
      CONVERT(varchar, CAST(ISNULL(SUM([Tot2]),0) AS MONEY),1) AS [Tot2]
      FROM
      (
        SELECT *
        FROM bd_admOlimpia.dbo.adusr
      ) AS usr
      LEFT JOIN 
      (
      SELECT vtvtaCusr,
      ISNULL([1],0) AS [Enero1],
      ISNULL([2],0) AS [Febrero1],
      ISNULL([3],0) AS [Marzo1],
      ISNULL([4],0) AS [Abril1],
      ISNULL([5],0) AS [Mayo1],
      ISNULL([6],0) AS [Junio1],
      ISNULL([7],0) AS [Julio1],
      ISNULL([8],0) AS [Agosto1],
      ISNULL([9],0) AS [Septiembre1],
      ISNULL([10],0) AS [Octubre1],
      ISNULL([11],0) AS [Noviembre1],
      ISNULL([12],0) AS [Diciembre1],
      ".implode($group_sum_tot)." AS [tot1]
      FROM
        (
        SELECT vtvtaCusr, MONTH(vtvtaFtra) [mes], SUM(vtvtaImpT - vtvtaDesT) AS total
        FROM vtVta
        WHERE vtvtaMdel = 0
        AND vtvtaFtra IS NOT NULL
        AND YEAR(vtvtaFtra) = 2021
        GROUP BY vtvtaCusr, MONTH(vtvtaFtra)
        ) AS venta
        PIVOT
        (
          SUM(total)
          FOR [mes] IN([1],[2],[3],[4],[5],[6],[7],[8],[9],[10],[11],[12])
        ) AS PivoTable
      ) totalventa1 ON totalventa1.vtvtaCusr = usr.adusrCusr
      LEFT JOIN 
      (
      SELECT vtvtaCusr,
      ISNULL([1],0) AS [Enero2],
      ISNULL([2],0) AS [Febrero2],
      ISNULL([3],0) AS [Marzo2],
      ISNULL([4],0) AS [Abril2],
      ISNULL([5],0) AS [Mayo2],
      ISNULL([6],0) AS [Junio2],
      ISNULL([7],0) AS [Julio2],
      ISNULL([8],0) AS [Agosto2],
      ISNULL([9],0) AS [Septiembre2],
      ISNULL([10],0) AS [Octubre2],
      ISNULL([11],0) AS [Noviembre2],
      ISNULL([12],0) AS [Diciembre2],
      ".implode($group_sum_tot)." AS [Tot2]
      FROM
        (
        SELECT vtvtaCusr, MONTH(vtvtaFtra) [mes], SUM(vtvtaImpT - vtvtaDesT) AS total
        FROM vtVta
        WHERE vtvtaMdel = 0
        AND vtvtaFtra IS NOT NULL
        AND YEAR(vtvtaFtra) = 2022
        GROUP BY vtvtaCusr, MONTH(vtvtaFtra)
        ) AS venta
        PIVOT
        (
          SUM(total)
          FOR [mes] IN([1],[2],[3],[4],[5],[6],[7],[8],[9],[10],[11],[12])
        ) AS PivoTable
      ) totalventa2 ON totalventa2.vtvtaCusr = usr.adusrCusr
      WHERE " . $usr_general . "
    ";
    $total_general = DB::connection('sqlsrv')->select(DB::raw($query_general));
    $total = [];
    foreach ($segmento as $key) {
      $usr = "adusrCusr IN (" . implode(",", $key['users']) . ")";
      $sql_total = "
      SELECT 
      ".implode($group_mes_sum)."
      CONVERT(varchar, CAST(ISNULL(SUM([Tot1]),0) AS MONEY),1) AS [Tot1],
      CONVERT(varchar, CAST(ISNULL(SUM([Tot2]),0) AS MONEY),1) AS [Tot2]
      FROM
      (
        SELECT *
        FROM bd_admOlimpia.dbo.adusr
      ) AS usr
      LEFT JOIN 
      (
      SELECT vtvtaCusr,
      ISNULL([1],0) AS [Enero1],
      ISNULL([2],0) AS [Febrero1],
      ISNULL([3],0) AS [Marzo1],
      ISNULL([4],0) AS [Abril1],
      ISNULL([5],0) AS [Mayo1],
      ISNULL([6],0) AS [Junio1],
      ISNULL([7],0) AS [Julio1],
      ISNULL([8],0) AS [Agosto1],
      ISNULL([9],0) AS [Septiembre1],
      ISNULL([10],0) AS [Octubre1],
      ISNULL([11],0) AS [Noviembre1],
      ISNULL([12],0) AS [Diciembre1],
      ".implode($group_sum_tot)." AS [tot1]
      FROM
        (
        SELECT vtvtaCusr, MONTH(vtvtaFtra) [mes], SUM(vtvtaImpT - vtvtaDesT) AS total
        FROM vtVta
        WHERE vtvtaMdel = 0
        AND vtvtaFtra IS NOT NULL
        AND YEAR(vtvtaFtra) = 2021
        GROUP BY vtvtaCusr, MONTH(vtvtaFtra)
        ) AS venta
        PIVOT
        (
          SUM(total)
          FOR [mes] IN([1],[2],[3],[4],[5],[6],[7],[8],[9],[10],[11],[12])
        ) AS PivoTable
      ) totalventa1 ON totalventa1.vtvtaCusr = usr.adusrCusr
      LEFT JOIN 
      (
      SELECT vtvtaCusr,
      ISNULL([1],0) AS [Enero2],
      ISNULL([2],0) AS [Febrero2],
      ISNULL([3],0) AS [Marzo2],
      ISNULL([4],0) AS [Abril2],
      ISNULL([5],0) AS [Mayo2],
      ISNULL([6],0) AS [Junio2],
      ISNULL([7],0) AS [Julio2],
      ISNULL([8],0) AS [Agosto2],
      ISNULL([9],0) AS [Septiembre2],
      ISNULL([10],0) AS [Octubre2],
      ISNULL([11],0) AS [Noviembre2],
      ISNULL([12],0) AS [Diciembre2],
      ".implode($group_sum_tot)." AS [Tot2]
      FROM
        (
        SELECT vtvtaCusr, MONTH(vtvtaFtra) [mes], SUM(vtvtaImpT - vtvtaDesT) AS total
        FROM vtVta
        WHERE vtvtaMdel = 0
        AND vtvtaFtra IS NOT NULL
        AND YEAR(vtvtaFtra) = 2022
        GROUP BY vtvtaCusr, MONTH(vtvtaFtra)
        ) AS venta
        PIVOT
        (
          SUM(total)
          FOR [mes] IN([1],[2],[3],[4],[5],[6],[7],[8],[9],[10],[11],[12])
        ) AS PivoTable
      ) totalventa2 ON totalventa2.vtvtaCusr = usr.adusrCusr
      WHERE " . $usr . "";
      $total[] = [$key['name'] => DB::connection('sqlsrv')->select(DB::raw($sql_total))];
      $sql_usr = "
      SELECT 
      adusrCusr, adusrNomb,
      ".implode($group_mes)."
      CONVERT(varchar, CAST(ISNULL([Tot1],0) AS MONEY),1) AS [Tot1],
      CONVERT(varchar, CAST(ISNULL([Tot2],0) AS MONEY),1) AS [Tot2]
      FROM
      (
        SELECT *
        FROM bd_admOlimpia.dbo.adusr
      ) AS usr
      LEFT JOIN 
      (
      SELECT vtvtaCusr,
      ISNULL([1],0) AS [Enero1],
      ISNULL([2],0) AS [Febrero1],
      ISNULL([3],0) AS [Marzo1],
      ISNULL([4],0) AS [Abril1],
      ISNULL([5],0) AS [Mayo1],
      ISNULL([6],0) AS [Junio1],
      ISNULL([7],0) AS [Julio1],
      ISNULL([8],0) AS [Agosto1],
      ISNULL([9],0) AS [Septiembre1],
      ISNULL([10],0) AS [Octubre1],
      ISNULL([11],0) AS [Noviembre1],
      ISNULL([12],0) AS [Diciembre1],
      ".implode($group_sum_tot)." AS [tot1]
      FROM
        (
        SELECT vtvtaCusr, MONTH(vtvtaFtra) [mes], SUM(vtvtaImpT - vtvtaDesT) AS total
        FROM vtVta
        WHERE vtvtaMdel = 0
        AND vtvtaFtra IS NOT NULL
        AND YEAR(vtvtaFtra) = 2021
        GROUP BY vtvtaCusr, MONTH(vtvtaFtra)
        ) AS venta
        PIVOT
        (
          SUM(total)
          FOR [mes] IN([1],[2],[3],[4],[5],[6],[7],[8],[9],[10],[11],[12])
        ) AS PivoTable
      ) totalventa1 ON totalventa1.vtvtaCusr = usr.adusrCusr
      LEFT JOIN 
      (
      SELECT vtvtaCusr,
      ISNULL([1],0) AS [Enero2],
      ISNULL([2],0) AS [Febrero2],
      ISNULL([3],0) AS [Marzo2],
      ISNULL([4],0) AS [Abril2],
      ISNULL([5],0) AS [Mayo2],
      ISNULL([6],0) AS [Junio2],
      ISNULL([7],0) AS [Julio2],
      ISNULL([8],0) AS [Agosto2],
      ISNULL([9],0) AS [Septiembre2],
      ISNULL([10],0) AS [Octubre2],
      ISNULL([11],0) AS [Noviembre2],
      ISNULL([12],0) AS [Diciembre2],
      ".implode($group_sum_tot)." AS [Tot2]
      FROM
        (
        SELECT vtvtaCusr, MONTH(vtvtaFtra) [mes], SUM(vtvtaImpT - vtvtaDesT) AS total
        FROM vtVta
        WHERE vtvtaMdel = 0
        AND vtvtaFtra IS NOT NULL
        AND YEAR(vtvtaFtra) = 2022
        GROUP BY vtvtaCusr, MONTH(vtvtaFtra)
        ) AS venta
        PIVOT
        (
          SUM(total)
          FOR [mes] IN([1],[2],[3],[4],[5],[6],[7],[8],[9],[10],[11],[12])
        ) AS PivoTable
      ) totalventa2 ON totalventa2.vtvtaCusr = usr.adusrCusr
      WHERE " . $usr . "
      ORDER BY adusrNomb;
      ";
      $total_seg[] = [$key['name'] => DB::connection('sqlsrv')->select(DB::raw($sql_usr))];
    }

    foreach ($almacen_reg as $key) {
      $alm = "inalmCalm IN (" . implode(",", $key['alm']) . ")";
      $sql_total_regional = "
      SELECT 
      ".implode($group_mes_sum)."
      CONVERT(varchar, CAST(ISNULL(SUM([Tot1]),0) AS MONEY),1) AS [Tot1],
      CONVERT(varchar, CAST(ISNULL(SUM([Tot2]),0) AS MONEY),1) AS [Tot2]
      FROM
      (
        SELECT *
        FROM inalm
      ) AS almacen
      LEFT JOIN 
      (
      SELECT vtvtaCalm,
      ISNULL([1],0) AS [Enero1],
      ISNULL([2],0) AS [Febrero1],
      ISNULL([3],0) AS [Marzo1],
      ISNULL([4],0) AS [Abril1],
      ISNULL([5],0) AS [Mayo1],
      ISNULL([6],0) AS [Junio1],
      ISNULL([7],0) AS [Julio1],
      ISNULL([8],0) AS [Agosto1],
      ISNULL([9],0) AS [Septiembre1],
      ISNULL([10],0) AS [Octubre1],
      ISNULL([11],0) AS [Noviembre1],
      ISNULL([12],0) AS [Diciembre1],
      ".implode($group_sum_tot)." AS [tot1]
      FROM
        (
        SELECT vtvtaCalm, MONTH(vtvtaFtra) [mes], SUM(vtvtaImpT - vtvtaDesT) AS total
        FROM vtVta
        WHERE vtvtaMdel = 0
        AND vtvtaFtra IS NOT NULL
        AND YEAR(vtvtaFtra) = 2021
        GROUP BY vtvtaCalm, MONTH(vtvtaFtra)
        ) AS venta
        PIVOT
        (
          SUM(total)
          FOR [mes] IN([1],[2],[3],[4],[5],[6],[7],[8],[9],[10],[11],[12])
        ) AS PivoTable
      ) totalventa1 ON totalventa1.vtvtaCalm = almacen.inalmCalm
      LEFT JOIN 
      (
      SELECT vtvtaCalm,
      ISNULL([1],0) AS [Enero2],
      ISNULL([2],0) AS [Febrero2],
      ISNULL([3],0) AS [Marzo2],
      ISNULL([4],0) AS [Abril2],
      ISNULL([5],0) AS [Mayo2],
      ISNULL([6],0) AS [Junio2],
      ISNULL([7],0) AS [Julio2],
      ISNULL([8],0) AS [Agosto2],
      ISNULL([9],0) AS [Septiembre2],
      ISNULL([10],0) AS [Octubre2],
      ISNULL([11],0) AS [Noviembre2],
      ISNULL([12],0) AS [Diciembre2],
      ".implode($group_sum_tot)." AS [Tot2]
      FROM
        (
        SELECT vtvtaCalm, MONTH(vtvtaFtra) [mes], SUM(vtvtaImpT - vtvtaDesT) AS total
        FROM vtVta
        WHERE vtvtaMdel = 0
        AND vtvtaFtra IS NOT NULL
        AND YEAR(vtvtaFtra) = 2022
        GROUP BY vtvtaCalm, MONTH(vtvtaFtra)
        ) AS venta
        PIVOT
        (
          SUM(total)
          FOR [mes] IN([1],[2],[3],[4],[5],[6],[7],[8],[9],[10],[11],[12])
        ) AS PivoTable
      ) totalventa2 ON totalventa2.vtvtaCalm = almacen.inalmCalm
      WHERE " . $alm . "";
      $total_regional[] = [$key['name'] => DB::connection('sqlsrv')->select(DB::raw($sql_total_regional))];
      $sql_regional = "
      SELECT 
      inalmCalm, inalmNomb,
      ".implode($group_mes)."
      CONVERT(varchar, CAST(ISNULL([Tot1],0) AS MONEY),1) AS [Tot1],
      CONVERT(varchar, CAST(ISNULL([Tot2],0) AS MONEY),1) AS [Tot2]
      FROM
      (
        SELECT *
        FROM inalm
      ) AS almacen
      LEFT JOIN 
      (
      SELECT vtvtaCalm,
      ISNULL([1],0) AS [Enero1],
      ISNULL([2],0) AS [Febrero1],
      ISNULL([3],0) AS [Marzo1],
      ISNULL([4],0) AS [Abril1],
      ISNULL([5],0) AS [Mayo1],
      ISNULL([6],0) AS [Junio1],
      ISNULL([7],0) AS [Julio1],
      ISNULL([8],0) AS [Agosto1],
      ISNULL([9],0) AS [Septiembre1],
      ISNULL([10],0) AS [Octubre1],
      ISNULL([11],0) AS [Noviembre1],
      ISNULL([12],0) AS [Diciembre1],
      ".implode($group_sum_tot)." AS [tot1]
      FROM
        (
        SELECT vtvtaCalm, MONTH(vtvtaFtra) [mes], SUM(vtvtaImpT - vtvtaDesT) AS total
        FROM vtVta
        WHERE vtvtaMdel = 0
        AND vtvtaFtra IS NOT NULL
        AND YEAR(vtvtaFtra) = 2021
        GROUP BY vtvtaCalm, MONTH(vtvtaFtra)
        ) AS venta
        PIVOT
        (
          SUM(total)
          FOR [mes] IN([1],[2],[3],[4],[5],[6],[7],[8],[9],[10],[11],[12])
        ) AS PivoTable
      ) totalventa1 ON totalventa1.vtvtaCalm = almacen.inalmCalm
      LEFT JOIN 
      (
      SELECT vtvtaCalm,
      ISNULL([1],0) AS [Enero2],
      ISNULL([2],0) AS [Febrero2],
      ISNULL([3],0) AS [Marzo2],
      ISNULL([4],0) AS [Abril2],
      ISNULL([5],0) AS [Mayo2],
      ISNULL([6],0) AS [Junio2],
      ISNULL([7],0) AS [Julio2],
      ISNULL([8],0) AS [Agosto2],
      ISNULL([9],0) AS [Septiembre2],
      ISNULL([10],0) AS [Octubre2],
      ISNULL([11],0) AS [Noviembre2],
      ISNULL([12],0) AS [Diciembre2],
      ".implode($group_sum_tot)." AS [Tot2]
      FROM
        (
        SELECT vtvtaCalm, MONTH(vtvtaFtra) [mes], SUM(vtvtaImpT - vtvtaDesT) AS total
        FROM vtVta
        WHERE vtvtaMdel = 0
        AND vtvtaFtra IS NOT NULL
        AND YEAR(vtvtaFtra) = 2022
        GROUP BY vtvtaCalm, MONTH(vtvtaFtra)
        ) AS venta
        PIVOT
        (
          SUM(total)
          FOR [mes] IN([1],[2],[3],[4],[5],[6],[7],[8],[9],[10],[11],[12])
        ) AS PivoTable
      ) totalventa2 ON totalventa2.vtvtaCalm = almacen.inalmCalm
      WHERE " . $alm . "
      ORDER BY inalmNomb;
      ";
      $total_seg_regional[] = [$key['name'] => DB::connection('sqlsrv')->select(DB::raw($sql_regional))];
    }
    return view('reports.vista.prueba', compact('total_general', 'total', 'total_seg', 'options', 'total_regional', 'total_seg_regional'));
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    //
  }
}
