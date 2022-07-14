<?php

namespace App\Http\Controllers\Reports;

use App\Exports\ResumenMexVentasExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use PhpParser\Node\Stmt\Foreach_;
use App\Exports\ResumenVentasExport;

class ResumenMesVentasController extends Controller
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
      ['name'  => 'BALLIVIAN', 'abrv' => 'BALLIVIAN', 'users' => [22, 41, 49, 46, 61, 68, 69]],
      ['name' => 'HANDAL', 'abrv' => 'HANDAL', 'users' => [26, 42, 50, 28]],
      ['name' => 'MARISCAL', 'abrv' => 'MARISCAL', 'users' => [38, 44, 51, 37, 67]],
      ['name' => 'CALACOTO', 'abrv' => 'CALACOTO', 'users' => [32, 43, 52, 29, 57, 74]],
      ['name' => 'INSTITUCIONALES', 'abrv' => 'INSTITUCIONALES', 'users' => [16, 17, 62, 56, 3, 58, 4]],
      ['name' => 'MAYORISTAS', 'abrv' => 'MAYORISTAS', 'users' => [18, 19, 55, 21, 20]],
      ['name' => 'SANTA CRUZ', 'abrv' => 'SANTA CRUZ', 'users' => [40, 39]],
    ];
    $retail = [
      ['name'  => 'BALLIVIAN', 'abrv' => 'BALLIVIAN', 'users' => [22, 49, 68]],
      ['name' => 'HANDAL', 'abrv' => 'HANDAL', 'users' => [26, 50, 69]],
      ['name' => 'MARISCAL', 'abrv' => 'MARISCAL', 'users' => [38, 51, 67]],
      ['name' => 'CALACOTO', 'abrv' => 'CALACOTO', 'users' => [32, 52]],
    ];
    $regional = [
      ['name' => 'REGIONAL1', 'abrv' => 'REGIONAL1', 'usr' => [63]],
      ['name' => 'REGIONAL2', 'abrv' => 'REGIONAL2', 'usr' => [64]],
    ];
    $almacen_reg = [
      ['name' => 'REGIONAL1', 'abrv' => 'REGIONAL1', 'alm' => [57, 58]],
      ['name' => 'REGIONAL2', 'abrv' => 'REGIONAL2', 'alm' => [59, 60, 61]],
    ];
    $general = [22, 41, 49, 46, 26, 42, 50, 28, 38, 44, 51, 37, 32, 43, 52, 29, 57, 16, 17, 18, 19, 55, 21, 40, 39, 62, 74, 20, 56, 3, 58, 4, 61, 63, 64, 67, 68, 69];

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
        $group_mes_sum[] = "CONVERT(varchar, CAST(ISNULL(SUM([" . $value . "1]),0) AS MONEY),1) AS [" . $value . "1],
        CONVERT(varchar, CAST(ISNULL(SUM([" . $value . "2]),0) AS MONEY),1) AS [" . $value . "2],";
        $group_mes[] = "CONVERT(varchar, CAST(ISNULL([" . $value . "1],0) AS MONEY),1) AS [" . $value . "1],
        CONVERT(varchar, CAST(ISNULL([" . $value . "2],0) AS MONEY),1) AS [" . $value . "2],";
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
      " . implode($group_mes_sum) . "
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
      " . implode($group_sum_tot) . " AS [tot1]
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
      " . implode($group_sum_tot) . " AS [Tot2]
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
      $usr_total = "adusrCusr IN (" . implode(",", $key['users']) . ")";
      $usr = "adusrCusr IN (" . implode(",", $key['users']) . ") AND adusrCusr NOT IN (22,49,68,26,50,69,38,51,67,32,52)";
      $sql_total = "
      SELECT 
      " . implode($group_mes_sum) . "
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
      " . implode($group_sum_tot) . " AS [tot1]
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
      " . implode($group_sum_tot) . " AS [Tot2]
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
      WHERE " . $usr_total . "";
      $total[] = [$key['name'] => DB::connection('sqlsrv')->select(DB::raw($sql_total))];
      $sql_usr = "
      SELECT 
      adusrCusr, adusrNomb,
      " . implode($group_mes) . "
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
      " . implode($group_sum_tot) . " AS [tot1]
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
      " . implode($group_sum_tot) . " AS [Tot2]
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
    // dd($total_seg[0]['BALLIVIAN']);
    foreach ($almacen_reg as $key) {
      $alm = "inalmCalm IN (" . implode(",", $key['alm']) . ")";
      $sql_total_regional = "
      SELECT 
      " . implode($group_mes_sum) . "
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
      " . implode($group_sum_tot) . " AS [tot1]
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
      " . implode($group_sum_tot) . " AS [Tot2]
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
      " . implode($group_mes) . "
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
      " . implode($group_sum_tot) . " AS [tot1]
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
      " . implode($group_sum_tot) . " AS [Tot2]
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
    foreach ($retail as $key) {
      $usr_retail = "adusrCusr IN (" . implode(",", $key['users']) . ")";
      $sql_total_retail = "
      SELECT 
      " . implode($group_mes_sum) . "
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
      " . implode($group_sum_tot) . " AS [tot1]
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
      " . implode($group_sum_tot) . " AS [Tot2]
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
      WHERE " . $usr_retail . "";
      //dd($sql_total_retail);
      $total_retail[] = [$key['name'] => DB::connection('sqlsrv')->select(DB::raw($sql_total_retail))];
    }

    $ballExcel = [
      'retail' => [
        '2019' => ['Enero' => 186044.81, 'Febrero' => 268987.64, 'Marzo' => 118553.95, 'Abril' => 127472.30, 'Mayo' => 101707.24, 'Junio' => 105679.51, 'Julio' => 122298.99, 'Agosto' => 103953.14, 'Septiembre' => 122265.63, 'Octubre' => 110176.42, 'Noviembre' => 101186.86, 'Diciembre' => 143692.43],
        '2020' => ['Enero' => 155402.37, 'Febrero' => 219199.19, 'Marzo' => 59161.67, 'Abril' => 0, 'Mayo' => 111.72, 'Junio' => 95990.49, 'Julio' => 49237.09, 'Agosto' => 57718.75, 'Septiembre' => 92762.62, 'Octubre' => 80767.23, 'Noviembre' => 181953.82, 'Diciembre' => 116644.91],
        '2021' => ['Enero' => 110191.12, 'Febrero' => 161395.70],
      ],
      'libros' => [
        '2019' => ['Enero' => 34681.10, 'Febrero' => 226669.10, 'Marzo' => 53699.00, 'Abril' => 20797.80, 'Mayo' => 18148.70, 'Junio' => 9921.65, 'Julio' => 13390.90, 'Agosto' => 9987.60, 'Septiembre' => 29328.05, 'Octubre' => 13426.50, 'Noviembre' => 3546.10, 'Diciembre' => 11672.55],
        '2020' => ['Enero' => 51279.30, 'Febrero' => 244799.70, 'Marzo' => 37423.20, 'Abril' => 0, 'Mayo' => 611.30, 'Junio' => 13355.80, 'Julio' => 6754.60, 'Agosto' => 6584.40, 'Septiembre' => 9148.90, 'Octubre' => 14298.98, 'Noviembre' => 12334.70, 'Diciembre' => 8234.82],
        '2021' => ['Enero' => 11546.90, 'Febrero' => 136346.80],
      ],
      'instit' => [
        '2019' => ['Enero' => 10541.11, 'Febrero' => 4982.37, 'Marzo' => 5025.15, 'Abril' => 7765.69, 'Mayo' => 10391.18, 'Junio' => 34635.60, 'Julio' => 5667.62, 'Agosto' => 6171.23, 'Septiembre' => 51452.55, 'Octubre' => 9205.80, 'Noviembre' => 23525.70, 'Diciembre' => 14567.71],
        '2020' => ['Enero' => 11060.06, 'Febrero' => 14108.67, 'Marzo' => 31481.55, 'Abril' => 0, 'Mayo' => 0, 'Junio' => 4043.40, 'Julio' => 36627.93, 'Agosto' => 12191.53, 'Septiembre' => 14319.95, 'Octubre' => 0, 'Noviembre' => 770.06, 'Diciembre' => 12965.31],
        '2021' => ['Enero' => 20685.00, 'Febrero' => 4530.41],
      ],
    ];

    $arrayball19 = [];
    $arrayball20 = [];
    $count19 = 0;
    $count20 = 0;
    foreach ($ballExcel as $key => $value) {
      // dd($key);
      foreach ($options as $i => $j) {
        $count19 = $count19 + $value[2019][$j];
        $count20 = $count20 + $value[2020][$j];
      }
      $arrayball19 [$key] = $count19;
      $arrayball20 [$key] = $count20;
      $count19 = 0;
      $count20 = 0;
    }

    // dd($arrayball19['retail']);
    
    if ($request->gen == "export") {
      $export = new ResumenVentasExport();
      return Excel::download($export, 'Reporte de Stock Actual.xlsx');
    } else {
      //return dd($titulos);
      return view('reports.vista.resumenxmes', compact('total_general', 'total', 'total_seg', 'total_retail', 'options', 'total_regional', 'total_seg_regional', 'arrayball19', 'arrayball20'));
    }
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
