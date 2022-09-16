<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use DB;
use Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\VentaCobranzaExport;

class VentaCobranzaController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    return view('reports.ventascobranzas');
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
    if (Auth::user()->id == 37 || Auth::user()->id == 9 || Auth::user()->id == 51 || Auth::user()->id == 14 || Auth::user()->id == 15 || Auth::user()->id == 20 || Auth::user()->id == 6 || Auth::user()->id == 34) {
      $usuario = "";
    }
    if (Auth::user()->id == 30) {
      $usuario = "AND adusrCusr = 46";
    }
    if (Auth::user()->id == 21) {
      $usuario = "AND adusrCusr = 9";
    }
    if (Auth::user()->id == 49) {
      $usuario = "AND adusrCusr = 74";
    }
    if (Auth::user()->id == 4) {
      $usuario = "AND adusrCusr = 62";
    }
    if (Auth::user()->id == 35) {
      $usuario = "AND adusrCusr = 55";
    }
    if (Auth::user()->id == 38) {
      $usuario = "AND adusrCusr = 18";
    }
    if (Auth::user()->id == 7) {
      $usuario = "AND adusrCusr = 16";
    }
    if (Auth::user()->id == 39) {
      $usuario = "AND adusrCusr = 21";
    }
    if (Auth::user()->id == 29) {
      $usuario = "AND adusrCusr = 19";
    }
    if (Auth::user()->id == 40) {
      $usuario = "AND adusrCusr = 28";
    }
    if (Auth::user()->id == 28) {
      $usuario = "AND adusrCusr = 37";
    }
    if (Auth::user()->id == 35) {
      $usuario = "AND adusrCusr = 63";
    }
    if (Auth::user()->id == 38) {
      $usuario = "AND adusrCusr = 64";
    }
    if (Auth::user()->id == 46) {
      $usuario = "AND adusrCusr = 40";
    }
    if (Auth::user()->id == 46) {
      $usuario = "AND adusrCusr = 39";
    }
    $fini = date("d/m/Y", strtotime($request->fini));
    $ffin = date("d/m/Y", strtotime($request->ffin));
    $fecha = $request->ffin;
    $fil = "DECLARE @fini DATE, @ffin DATE, @fechaA DATE
        SELECT @fini = '" . $fini . "', @ffin = '" . $ffin . "', @fechaA = '" . date("d/m/Y") . "'";
    $query = "
    SELECT 
    adusrCusr as idUser,
    loc AS 'Local', 
    tip AS 'Tipo', 
    SaldoAnterior as 'SaldoAnterior',
    SUM(efe) + SUM(ban) + SUM(tar) + SUM(mot) + SUM(otr) as 'Contado', 
    SUM(cxc) as 'Credito', 
    SUM(tot) as 'Total',  
    ISNULL(VIGENTE,0) AS 'Vigente',
    ISNULL(VENCIDO,0) AS 'Vencido',
    ISNULL(MORA,0) AS 'Mora',
    ISNULL(MORA,0) + ISNULL(VENCIDO,0) + ISNULL(VIGENTE,0) AS 'Total2',
    SaldoAnterior + SUM(tot) - (MORA + VENCIDO + VIGENTE) AS 'SaldoActual'
    into #mov
    FROM
    (
        SELECT 
        adusrCusr,
        inlocNomb as 'Loc',
        adusrNomb AS 'Tip',
        vtvtaTotT as 'tot', 
        admonAbrv as 'mon', 
        cptraCajS as 'efe', 
        cptraBanS as 'ban', 
        cptraCxcS as 'cxc',
        cptraTarS as 'tar', 
        cptraMcnS as 'Mot', cptraCheS+cptraCmpS+cptraOpPd as 'Otr'
        FROM cptra
        JOIN vtVta ON vtvtaNtra = cptraNtrI
        JOIN bd_admOlimpia.dbo.adusr ON adusrCusr = vtvtaCusr
        JOIN bd_admOlimpia.dbo.admon ON admonCmon = vtvtaMtra 
        join inloc ON inlocCloc = vtvtaCloc
        WHERE 
        cptraMdel = 0 AND cptraTtra = 21
      AND cptraFtra BETWEEN @fini AND @ffin
    ) as venta
    JOIN (
      SELECT 
      cxcTrCcbr,
      ISNULL(VIGENTE,0) AS 'Vigente',
      ISNULL(VENCIDO,0) AS 'Vencido',
      ISNULL(MORA,0) AS 'Mora',
      ISNULL(MORA,0) + ISNULL(VENCIDO,0) + ISNULL(VIGENTE,0) AS 'Total'
      FROM (
        SELECT
        cxcTrCcbr,
        ISNULL(cobros.AcuentaF,0) as 'Saldo',
        CASE 
        WHEN DATEDIFF(DAY, cxcTrFtra, @fechaA) <= 30/*DiasPlazo*/ THEN 'VIGENTE'
        WHEN DATEDIFF(DAY, cxcTrFtra, @fechaA) <= (30/*DiasPlazo*/ + 15) THEN 'VENCIDO'
        WHEN DATEDIFF(DAY, cxcTrFtra, @fechaA) > (30/*DiasPlazo*/ + 15) THEN 'MORA'
        END as estado
        FROM cxcTr 
        JOIN bd_admOlimpia.dbo.admon ON admonCmon = cxcTrMtra AND admonMdel = 0
        JOIN bd_admOlimpia.dbo.adusr ON adusrCusr = cxcTrCcbr AND adusrMdel = 0
        JOIN inloc ON inlocCloc = cxcTrCloc AND inlocMdel = 0
        JOIN cutcu ON cutcuCtcu = cxcTrCtcu AND cutcuMdel = 0      
          LEFT JOIN
          (
            SELECT liqdCNtcc, SUM(liqdCAcmt) as AcuentaF
            FROM liqdC
            JOIN liqXC ON liqdCNtra = liqXCNtra
            WHERE liqXCMdel = 0 
            AND liqXCFtra <= @ffin
            AND liqdCAcmt >= 1
            GROUP BY liqdCNtcc
          )as cobros
          ON cobros.liqdCNtcc = cxcTrNtra
          WHERE (cxcTrImpt - cxcTrAcmt) <> 0 AND cxcTrMdel = 0
        ) as cxc
      PIVOT
      (
        SUM(Saldo)
        FOR estado IN (MORA,VENCIDO,VIGENTE)
      ) AS pivotable
    ) as cxc ON cxc.cxcTrCcbr = venta.adusrCusr
    JOIN (
      SELECT
      cxcTrCcbr,
      ISNULL(SUM(cobros.AcuentaF),0) as 'SaldoAnterior'
      FROM cxcTr 
      JOIN bd_admOlimpia.dbo.admon ON admonCmon = cxcTrMtra AND admonMdel = 0
      JOIN bd_admOlimpia.dbo.adusr ON adusrCusr = cxcTrCcbr AND adusrMdel = 0
      JOIN inloc ON inlocCloc = cxcTrCloc AND inlocMdel = 0
      JOIN cutcu ON cutcuCtcu = cxcTrCtcu AND cutcuMdel = 0      
        LEFT JOIN
        (
          SELECT liqdCNtcc, SUM(liqdCAcmt) as AcuentaF
          FROM liqdC
          JOIN liqXC ON liqdCNtra = liqXCNtra
          WHERE liqXCMdel = 0 
          AND liqXCFtra <= '31/12/2021'
          GROUP BY liqdCNtcc
        )as cobros
        ON cobros.liqdCNtcc = cxcTrNtra
        WHERE (cxcTrImpt - cxcTrAcmt) <> 0 AND cxcTrMdel = 0
    GROUP BY cxcTrCcbr
    ) as saldoAntarior ON saldoAntarior.cxcTrCcbr = venta.adusrCusr
    " . $usuario . "
    GROUP BY adusrCusr, loc, tip, SaldoAnterior, Vigente, Vencido, Mora
    ORDER BY loc, tip
    ";
    // dd($query);
    $insert = DB::connection('sqlsrv')->unprepared(DB::raw($fil . $query));
    $movimientos = DB::connection('sqlsrv')->select(DB::raw("
      select
      idUser as idUser,
      Local AS 'Local', 
      Tipo AS 'Tipo', 
      CONVERT(VARCHAR, cast(SaldoAnterior as money),1) as 'SaldoAnterior',CONVERT(VARCHAR, cast(Contado as money),1) as 'Contado', 
      CONVERT(VARCHAR, cast(Credito as money),1) as 'Credito', 
      CONVERT(VARCHAR, cast(Total as money),1) as 'Total',  
      CONVERT(VARCHAR, cast(ISNULL(VIGENTE,0) as money),1) AS 'Vigente',CONVERT(VARCHAR, cast(ISNULL(VENCIDO,0) as money),1) AS 'Vencido',CONVERT(VARCHAR, cast(ISNULL(MORA,0) as money),1) AS 'Mora',
      CONVERT(VARCHAR, cast(ISNULL(MORA,0) + ISNULL(VENCIDO,0) + ISNULL(VIGENTE,0) as money),1) AS 'Total2',
      CONVERT(VARCHAR, cast(SaldoActual as money),1) AS 'SaldoActual'
      FROM #mov
      ORDER BY Local
      "));
    $subTotal = DB::connection('sqlsrv')->select(DB::raw("
      select
      Local AS 'Local',
      CONVERT(VARCHAR, cast(SUM(SaldoAnterior) as money),1) as 'SaldoAnterior',
	    CONVERT(VARCHAR, cast(SUM(Contado) as money),1) as 'Contado', 
      CONVERT(VARCHAR, cast(SUM(Credito) as money),1) as 'Credito', 
      CONVERT(VARCHAR, cast(SUM(Total) as money),1) as 'Total',  
      CONVERT(VARCHAR, cast(ISNULL(SUM(VIGENTE),0) as money),1) AS 'Vigente',
	    CONVERT(VARCHAR, cast(ISNULL(SUM(VENCIDO),0) as money),1) AS 'Vencido',
	    CONVERT(VARCHAR, cast(ISNULL(SUM(MORA),0) as money),1) AS 'Mora',
      CONVERT(VARCHAR, cast(ISNULL(SUM(MORA),0) + ISNULL(SUM(VENCIDO),0) + ISNULL(SUM(VIGENTE),0) as money),1) AS 'Total2',
      CONVERT(VARCHAR, cast(SUM(SaldoActual) as money),1) AS 'SaldoActual'
      FROM #mov
	    GROUP BY Local
      ORDER BY Local
      "));
    $total = DB::connection('sqlsrv')->select(DB::raw("
      select
      CONVERT(VARCHAR, cast(SUM(SaldoAnterior) as money),1) as 'SaldoAnterior',
	    CONVERT(VARCHAR, cast(SUM(Contado) as money),1) as 'Contado', 
      CONVERT(VARCHAR, cast(SUM(Credito) as money),1) as 'Credito', 
      CONVERT(VARCHAR, cast(SUM(Total) as money),1) as 'Total',  
      CONVERT(VARCHAR, cast(ISNULL(SUM(VIGENTE),0) as money),1) AS 'Vigente',
	    CONVERT(VARCHAR, cast(ISNULL(SUM(VENCIDO),0) as money),1) AS 'Vencido',
	    CONVERT(VARCHAR, cast(ISNULL(SUM(MORA),0) as money),1) AS 'Mora',
      CONVERT(VARCHAR, cast(ISNULL(SUM(MORA),0) + ISNULL(SUM(VENCIDO),0) + ISNULL(SUM(VIGENTE),0) as money),1) AS 'Total2',
      CONVERT(VARCHAR, cast(SUM(SaldoActual) as money),1) AS 'SaldoActual'
      FROM #mov
      "));
    $resumen = [];
    // dd($subTotal);
    foreach ($movimientos as $key => $value) {
      if (!array_key_exists($value->Local, $resumen)) {
        $resumen[$value->Local] = [$movimientos[$key]];
      } else {
        array_push($resumen[$value->Local], $movimientos[$key]);
      }
    }
    foreach ($subTotal as $key => $value) {
      if (!array_key_exists($value->Local, $subTotal)) {
        $subTotal[$value->Local] = [$subTotal[$key]];
        unset($subTotal[$key]);
      } else {
        array_push($subTotal[$value->Local], $subTotal[$key]);
        unset($subTotal[$key]);
      }
    }
    // dd($resumen);
    if ($request->gen == "excel") {
      //return dd($pvp);
      $export = new VentaCobranzaExport($movimientos, $fini, $ffin);
      return Excel::download($export, 'Ventas Cobranzas.xlsx');
    } else {
      return view('reports.vista.ventascobranzas', compact('fini', 'ffin', 'fecha', 'resumen', 'subTotal', 'total'));
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
