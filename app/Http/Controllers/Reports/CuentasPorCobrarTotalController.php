<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use DB;
use Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CuentasPorCobrarTotalExport;

class CuentasPorCobrarTotalController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function index()
  {
    if (Auth::user()->authorizePermisos(['Cuentas Por Cobrar', 'Ver usuarios DualBiz'])) {
      $usuario = "";
    } else if (Auth::user()->authorizePermisos(['Cuentas Por Cobrar', 'Ver usuarios OAS'])) {
      $users = User::where('dbiz_user', '<>', NULL)->get()->pluck('dbiz_user')->toArray();
      $users = implode(",", $users);
      $usuario = "AND adusrCusr IN (" . $users . ")";
    } else {
      if (Auth::user()->dbiz_user == null) {
        $usuario = "AND adusrCusr = null";
      } else {
        $usuario = "AND adusrCusr = " . Auth::user()->dbiz_user;
      }
    }
    $query =
      "SELECT * 
        FROM bd_admOlimpia.dbo.adusr 
        WHERE adusrMdel = 0 " . $usuario . "
        AND (adusrCusr IN 
        (
            SELECT cxcTrCcbr
            FROM cxcTr
            WHERE cxcTrCcbr IN (2,18,19,21,39,40,55,63,64)
            GROUP BY cxcTrCcbr
        ))
        ORDER BY adusrNomb";
    $user = DB::connection('sqlsrv')->select(DB::raw($query));
    return view('reports.cuentasporcobrartotal', compact('user'));
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
    $user = "AND cxcTrCcbr IS NULL";
    $cliente = "";
    if ($request->cliente) {
      $cliente = "AND cxcTrNcto LIKE '%" . $request->cliente . "%'";
    }
    if ($request->options) {
      $user = "AND cxcTrCcbr IN (" . implode(",", $request->options) . ")";
    }
    $fecha = date("d/m/Y", strtotime($request->ffin));
    $query = "
      SELECT
      cxcTrCcto,
      LTRIM(RTRIM(cxcTrNcto)) as 'Cliente',
      venta.imLvtFech,
      venta.imLvtNrfc,
      cobros.liqXCGlos AS 'Glosa',
      isnull(imLvtRsoc,'-') as Rsocial,
      isnull(imLvtNNit,'-') as Nit,
      cxcTrImpt,
      CASE
      WHEN cobros.liqXCFtra <= DATEADD(DAY,10,venta.vtvtaFtra) then 'cont'
      else 'cred'
      END as Estado,
      CONVERT(date, cobros.liqXCFtra) as Fecha,
      ISNULL(cobros.AcuentaF,0) as 'ACuenta',
      adusrNomb,
      inlocNomb
      INTO #cxc
      FROM cxcTr
      LEFT JOIN cptra ON cptraNtrI = cxcTrNtrI
      LEFT JOIN inloc ON inlocCloc = cxcTrCloc
      JOIN bd_admOlimpia.dbo.adusr ON adusrCusr = cxcTrCcbr AND adusrMdel = 0
      LEFT JOIN
      (
          SELECT *
        FROM vtVta
        LEFT JOIN imLvt ON imlvtNvta = vtvtaNtra
      )as venta ON (imLvtNvta = cxcTrNtrI) AND imLvtMdel = 0
      LEFT JOIN
      (
          SELECT liqdCNtcc, liqdCAcmt as AcuentaF, liqXCFtra, liqXCGlos--,SUM(liqdCAcmt) as AcuentaF
          FROM liqdC
          JOIN liqXC ON liqdCNtra = liqXCNtra
          WHERE liqXCMdel = 0 
          AND liqXCFtra <= '" . $fecha . "'
      )as cobros ON cobros.liqdCNtcc = cxcTrNtra
      WHERE cxcTrMdel = 0
      " . $user . "
      " . $cliente . "
      ORDER BY imlvtNvta
    ";
    $insert = DB::connection('sqlsrv')->unprepared(DB::raw($query));
    $movimientos = DB::connection('sqlsrv')
      ->select(DB::raw(
        "SELECT
        cxcTrCcto,
        Cliente,
        Rsocial,
        Nit,
        adusrNomb,
        inlocNomb,
        REPLACE(cast(SUM(ISNULL(cxcTrImpt,0)) as decimal(10,2)),',', '.') AS importeCXC,
        REPLACE(cast(SUM(ISNULL(cont,0)) as decimal(10,2)),',', '.') AS cont,
        REPLACE(cast(SUM(ISNULL(cred,0)) as decimal(10,2)),',', '.') AS cred,
        REPLACE(cast(SUM(ISNULL(cxcTrImpt,0) - ISNULL(cont,0) - ISNULL(cred,0)) as decimal(10,2)),',', '.') AS saldo
        FROM (
            SELECT
            cxcTrCcto,
            Cliente,
            Estado,
            ACuenta,
            adusrNomb,
            inlocNomb,
          cxcTrImpt,
            Rsocial,
            Nit
            FROM #cxc
            --GROUP BY cxcTrCcto,Cliente,Estado,ACuenta,adusrNomb,inlocNomb,Rsocial,Nit
        ) AS sumcxc
        PIVOT
        (
            SUM(ACuenta)
            FOR Estado IN ([cred],[cont])
        ) AS pivotable
        GROUP BY cxcTrCcto,Cliente,Rsocial,Nit,adusrNomb,inlocNomb
        ORDER BY Cliente
        "
      ));
    // dd($movimientos);
    $titulos =
      [
        ['name' => 'Cliente', 'data' => 'Cliente', 'title' => 'Cliente', 'tip' => 'filtro'],
        ['name' => 'Rsocial', 'data' => 'Rsocial', 'title' => 'RazonSocial', 'tip' => 'filtro'],
        ['name' => 'Nit', 'data' => 'Nit', 'title' => 'NIT', 'tip' => 'filtro'],
        ['name' => 'adusrNomb', 'data' => 'adusrNomb', 'title' => 'Usuario', 'tip' => 'filtro'],
        ['name' => 'inlocNomb', 'data' => 'inlocNomb', 'title' => 'Local', 'tip' => 'filtro_select'],
        [],
        [],
        [],
        [],
      ];
    if ($request->gen == "excel") {
      $query_excel = "
        SELECT
        fechaNR,
        vtvtaNtra,
        Cliente,
        fechaFC,
        imLvtNrfc,
        Glosa,
        Rsocial,
        Nit,
        ImporteCXC,
        fechaAC,
        REPLACE(cast(ISNULL(cont,0) as decimal(10,2)),',', '.') AS cont,
        REPLACE(cast(ISNULL(cred,0) as decimal(10,2)),',', '.') AS cred,
        adusrNomb
        FROM (
          SELECT
          CONVERT(varchar,venta.vtvtaFtra,103) AS fechaNR,
          venta.vtvtaNtra,
          cxcTrCcto,
          cxcTrNcto AS 'Cliente',
          CONVERT(varchar,venta.imLvtFech,103) AS fechaFC,
          venta.imLvtNrfc,
          cobros.liqXCGlos AS 'Glosa',
          isnull(imLvtRsoc,'-') AS Rsocial,
          isnull(imLvtNNit,'-') AS Nit,
          cast(cxcTrImpt AS decimal(10,2))AS 'ImporteCXC',
          CASE
          WHEN cobros.liqXCFtra <= DATEADD(DAY,10,venta.vtvtaFtra) THEN 'cont'
          ELSE 'cred'
          END AS Estado,
          CONVERT(varchar,cobros.liqXCFtra,103) AS fechaAC,
          ISNULL(cobros.AcuentaF,0) AS 'ACuenta',
          adusrNomb
          FROM cxcTr
          LEFT JOIN cptra ON cptraNtrI = cxcTrNtrI
          JOIN bd_admOlimpia.dbo.adusr ON adusrCusr = cxcTrCcbr AND adusrMdel = 0
          LEFT JOIN
          (
            SELECT *
            FROM vtVta
            LEFT JOIN imLvt ON imlvtNvta = vtvtaNtra
          )AS venta ON (imLvtNvta = cxcTrNtrI) AND imLvtMdel = 0
          LEFT JOIN
          (
            SELECT liqdCNtcc, liqdCAcmt AS AcuentaF, liqXCFtra, liqXCGlos--,SUM(liqdCAcmt) as AcuentaF
            FROM liqdC
            JOIN liqXC ON liqdCNtra = liqXCNtra
            WHERE liqXCMdel = 0 
            AND liqXCFtra <= '" . $fecha . "'
            --GROUP BY liqdCNtcc
          )AS cobros ON cobros.liqdCNtcc = cxcTrNtra
          WHERE cxcTrMdel = 0
          " . $user . "
          " . $cliente . "
        ) AS pivotdetalle
        PIVOT
        (
          SUM(ACuenta)
          FOR Estado IN ([cont],[cred])
        ) AS pivotable
        ORDER BY fechaNR
      ";
      $sql_excel = DB::connection('sqlsrv')->select(DB::raw($query_excel));
      $export = new CuentasPorCobrarTotalExport($sql_excel, $fecha);
      return Excel::download($export, 'Cuentas Por Cobrar Total.xlsx');
    } elseif ($request->gen == "ver") {
      return view('reports.vista.cuentasporcobrartotal', compact('movimientos', 'titulos'));
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
