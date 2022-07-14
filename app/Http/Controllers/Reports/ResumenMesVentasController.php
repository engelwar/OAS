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
    
    //---
    $totalxSucursal=[
      ['name'=>'enero','datos'=>[
        
        '2019'=>[
             231267.02,368632.59,40247.20,440348.93,174490.36,173105.08,1063848.00,561600.52




           ]
      ]
      ]
    ];
    //---
    $grupoExcel = [
      ['name' => 'BALLIVIAN', 'datos' => [
        'retail' => [
          '2019' => [186044.81, 268987.64, 118553.95, 127472.30, 101707.24, 105679.51, 122298.99, 103953.14, 122265.63, 110176.42, 101186.86, 143692.43],
          '2020' => [155402.37, 219199.19, 59161.67, 0, 111.72, 95990.49, 49237.09, 57718.75, 92762.62, 80767.23, 181953.82, 116, 644.91],
          '2021' => [110191.12, 161395.70],
        ],
        'libros' => [
          '2019' => [34681.10, 226669.10, 53699.00, 20797.80, 18148.70, 9921.65, 13390.90, 9987.60, 29328.05, 13426.50, 3546.10, 11672.55],
          '2020' => [51279.30, 244799.70, 37423.20, 0, 611.30, 13355.80, 6754.60, 6584.40, 9148.90, 14298.98, 12334.70, 8234.82],
          '2021' => [11546.90, 136346.80],
        ],
        'instit' => [
          '2019' => [10541.11, 4982.37, 5025.15, 7765.69, 10391.18, 34635.60, 5667.62, 6171.23, 51452.55, 9205.80, 23525.70, 14567.71],
          '2020' => [11060.06, 14108.67, 31481.55, 0, 0, 4043.40, 36627.93, 12191.53, 14319.95, 0, 770.06, 12965.31],
          '2021' => [20685.00, 4530.41],
        ],
      ]],
      ['name' => 'HANDAL', 'datos' => [
        'retail' => [
          '2019' => [186044.81, 268987.64, 118553.95, 127472.30, 101707.24, 105679.51, 122298.99, 103953.14, 122265.63, 110176.42, 101186.86, 143692.43],
          '2020' => [155402.37, 219199.19, 59161.67, 0, 111.72, 95990.49, 49237.09, 57718.75, 92762.62, 80767.23, 181953.82, 116, 644.91],
          '2021' => [110191.12, 161395.70],
        ],
        'libros' => [
          '2019' => [34681.10, 226669.10, 53699.00, 20797.80, 18148.70, 9921.65, 13390.90, 9987.60, 29328.05, 13426.50, 3546.10, 11672.55],
          '2020' => [51279.30, 244799.70, 37423.20, 0, 611.30, 13355.80, 6754.60, 6584.40, 9148.90, 14298.98, 12334.70, 8234.82],
          '2021' => [11546.90, 136346.80],
        ],
        'instit' => [
          '2019' => [10541.11, 4982.37, 5025.15, 7765.69, 10391.18, 34635.60, 5667.62, 6171.23, 51452.55, 9205.80, 23525.70, 14567.71],
          '2020' => [11060.06, 14108.67, 31481.55, 0, 0, 4043.40, 36627.93, 12191.53, 14319.95, 0, 770.06, 12965.31],
          '2021' => [20685.00, 4530.41],
        ],
      ]],
      ['name' => 'MARISCAL', 'datos' => [
        'retail' => [
          '2019' => [186044.81, 268987.64, 118553.95, 127472.30, 101707.24, 105679.51, 122298.99, 103953.14, 122265.63, 110176.42, 101186.86, 143692.43],
          '2020' => [155402.37, 219199.19, 59161.67, 0, 111.72, 95990.49, 49237.09, 57718.75, 92762.62, 80767.23, 181953.82, 116, 644.91],
          '2021' => [110191.12, 161395.70],
        ],
        'libros' => [
          '2019' => [34681.10, 226669.10, 53699.00, 20797.80, 18148.70, 9921.65, 13390.90, 9987.60, 29328.05, 13426.50, 3546.10, 11672.55],
          '2020' => [51279.30, 244799.70, 37423.20, 0, 611.30, 13355.80, 6754.60, 6584.40, 9148.90, 14298.98, 12334.70, 8234.82],
          '2021' => [11546.90, 136346.80],
        ],
        'instit' => [
          '2019' => [10541.11, 4982.37, 5025.15, 7765.69, 10391.18, 34635.60, 5667.62, 6171.23, 51452.55, 9205.80, 23525.70, 14567.71],
          '2020' => [11060.06, 14108.67, 31481.55, 0, 0, 4043.40, 36627.93, 12191.53, 14319.95, 0, 770.06, 12965.31],
          '2021' => [20685.00, 4530.41],
        ],
      ]],
      ['name' => 'CALACOTO', 'datos' => [
        'retail' => [
          '2019' => [186044.81, 268987.64, 118553.95, 127472.30, 101707.24, 105679.51, 122298.99, 103953.14, 122265.63, 110176.42, 101186.86, 143692.43],
          '2020' => [155402.37, 219199.19, 59161.67, 0, 111.72, 95990.49, 49237.09, 57718.75, 92762.62, 80767.23, 181953.82, 116, 644.91],
          '2021' => [110191.12, 161395.70],
        ],
        'libros' => [
          '2019' => [34681.10, 226669.10, 53699.00, 20797.80, 18148.70, 9921.65, 13390.90, 9987.60, 29328.05, 13426.50, 3546.10, 11672.55],
          '2020' => [51279.30, 244799.70, 37423.20, 0, 611.30, 13355.80, 6754.60, 6584.40, 9148.90, 14298.98, 12334.70, 8234.82],
          '2021' => [11546.90, 136346.80],
        ],
        'instit' => [
          '2019' => [10541.11, 4982.37, 5025.15, 7765.69, 10391.18, 34635.60, 5667.62, 6171.23, 51452.55, 9205.80, 23525.70, 14567.71],
          '2020' => [11060.06, 14108.67, 31481.55, 0, 0, 4043.40, 36627.93, 12191.53, 14319.95, 0, 770.06, 12965.31],
          '2021' => [20685.00, 4530.41],
        ],
      ]],
    ];
// dd($grupoExcel,$options);
    if ($request->gen == "export") {
      $export = new ResumenVentasExport();
      return Excel::download($export, 'Reporte de Stock Actual.xlsx');
    } else {
      //return dd($titulos);
      return view('reports.vista.resumenxmes', compact('total_general', 'total', 'total_seg', 'total_retail', 'options', 'total_regional', 'total_seg_regional'));
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
