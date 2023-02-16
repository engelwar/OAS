<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use DB;
use Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CuentasPorCobrarTotalExport;
use PhpParser\Node\Stmt\Foreach_;

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
            --WHERE cxcTrCcbr IN (2,18,19,21,39,40,55,63,64)
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
    $fecha_cons = date("Y/m/d", strtotime($request->ffin));
    $query1 = "
      SELECT
      cxcTrImpt,
      CASE
      WHEN cobros.liqXCFtra <= DATEADD(DAY,10,venta.vtvtaFtra) then 'cont'
      else 'cred'
      END as Estado,
      CONVERT(date, cobros.liqXCFtra) as Fecha,
      ISNULL(cobros.AcuentaF,0) as 'ACuenta',
      adusrCusr,
      adusrNomb,
      inlocNomb
      INTO #cxc1
      FROM cxcTr
      LEFT JOIN cptra ON cptraNtrI = cxcTrNtrI
      LEFT JOIN inloc ON inlocCloc = cxcTrCloc
      JOIN bd_admOlimpia.dbo.adusr ON adusrCusr = cxcTrCcbr AND adusrMdel = 0
      LEFT JOIN
      (
          SELECT *
        FROM vtVta
        LEFT JOIN imLvt ON imlvtNvta = vtvtaNtra
        WHERe vtvtaMdel = 0
        AND vtvtaFtra <= '03/02/2023'
      )as venta ON (imLvtNvta = cxcTrNtrI) AND imLvtMdel = 0
      LEFT JOIN
      (
          SELECT liqdCNtcc, liqdCAcmt as AcuentaF, liqXCFtra, liqXCGlos--,SUM(liqdCAcmt) as AcuentaF
          FROM liqdC
          JOIN liqXC ON liqdCNtra = liqXCNtra
          WHERE liqXCMdel = 0 
      )as cobros ON cobros.liqdCNtcc = cxcTrNtra
      WHERE cxcTrMdel = 0
      ORDER BY imlvtNvta
    ";
    $insert1 = DB::connection('sqlsrv')->unprepared(DB::raw($query1));
    $movimientos1 = DB::connection('sqlsrv')
      ->select(DB::raw(
        "SELECT
        adusrCusr AS id_usuario_1,
        adusrNomb AS nomb_user_1,
        inlocNomb AS local_1,
        REPLACE(cast(SUM(ISNULL(cxcTrImpt,0)) as decimal(10,2)),',', '.') AS importeCXC_1,
        REPLACE(cast(SUM(ISNULL(cont,0)) as decimal(10,2)),',', '.') AS cont_1,
        REPLACE(cast(SUM(ISNULL(cred,0)) as decimal(10,2)),',', '.') AS cred_1,
        REPLACE(cast(SUM(ISNULL(cxcTrImpt,0) - ISNULL(cont,0) - ISNULL(cred,0)) as decimal(10,2)),',', '.') AS saldo_1
        FROM (
            SELECT
            Estado,
            ACuenta,
          adusrCusr,
            adusrNomb,
            inlocNomb,
            cxcTrImpt
            FROM #cxc1
            --GROUP BY cxcTrCcto,Cliente,Estado,ACuenta,adusrNomb,inlocNomb,Rsocial,Nit
        ) AS sumcxc
        PIVOT
        (
            SUM(ACuenta)
            FOR Estado IN ([cred],[cont])
        ) AS pivotable
        --where adusrCusr = 46
        GROUP BY adusrCusr,adusrNomb,inlocNomb
        ORDER BY adusrCusr
        "
      ));
    $query2 = "
      SELECT
      cxcTrCcto,
      LTRIM(RTRIM(cxcTrNcto)) as 'Cliente',
      --venta.imLvtFech,
      --venta.imLvtNrfc,
      --cobros.liqXCGlos AS 'Glosa',
      --isnull(imLvtRsoc,'-') as Rsocial,
      --isnull(imLvtNNit,'-') as Nit,
      cxcTrImpt,
      CASE
      WHEN cobros.liqXCFtra <= DATEADD(DAY,10,venta.vtvtaFtra) then 'cont'
      else 'cred'
      END as Estado,
      CONVERT(date, cobros.liqXCFtra) as Fecha,
      ISNULL(cobros.AcuentaF,0) as 'ACuenta',
      adusrCusr,
      adusrNomb,
      inlocNomb
      INTO #cxc2
      FROM cxcTr
      LEFT JOIN cptra ON cptraNtrI = cxcTrNtrI
      LEFT JOIN inloc ON inlocCloc = cxcTrCloc
      JOIN bd_admOlimpia.dbo.adusr ON adusrCusr = cxcTrCcbr AND adusrMdel = 0
      LEFT JOIN
      (
          SELECT *
        FROM vtVta
        LEFT JOIN imLvt ON imlvtNvta = vtvtaNtra
        WHERe vtvtaMdel = 0
        AND vtvtaFtra <= '03/02/2023'
      )as venta ON (imLvtNvta = cxcTrNtrI) AND imLvtMdel = 0
      LEFT JOIN
      (
          SELECT liqdCNtcc, liqdCAcmt as AcuentaF, liqXCFtra, liqXCGlos--,SUM(liqdCAcmt) as AcuentaF
          FROM liqdC
          JOIN liqXC ON liqdCNtra = liqXCNtra
          WHERE liqXCMdel = 0 
      )as cobros ON cobros.liqdCNtcc = cxcTrNtra
      WHERE cxcTrMdel = 0
      --AND cxcTrCcbr = 17
      --AND inlocCloc = 3
      --ORDER BY imlvtNvta
    ";
    $insert2 = DB::connection('sqlsrv')->unprepared(DB::raw($query2));
    $movimientos2 = DB::connection('sqlsrv')
      ->select(DB::raw(
        "SELECT
        cxcTrCcto AS id_cliente_2,
        Cliente AS nomb_cliente_2,
        adusrCusr AS id_usuario_2,
        adusrNomb AS nomb_user_2,
        inlocNomb AS local_2,
        REPLACE(cast(SUM(ISNULL(cxcTrImpt,0)) as decimal(10,2)),',', '.') AS importeCXC_2,
        REPLACE(cast(SUM(ISNULL(cont,0)) as decimal(10,2)),',', '.') AS cont_2,
        REPLACE(cast(SUM(ISNULL(cred,0)) as decimal(10,2)),',', '.') AS cred_2,
        REPLACE(cast(SUM(ISNULL(cxcTrImpt,0) - ISNULL(cont,0) - ISNULL(cred,0)) as decimal(10,2)),',', '.') AS saldo_2
        FROM (
            SELECT
            cxcTrCcto,
            Cliente,
            Estado,
            ACuenta,
          adusrCusr,
            adusrNomb,
            inlocNomb,
            cxcTrImpt
            FROM #cxc2
            --GROUP BY cxcTrCcto,Cliente,Estado,ACuenta,adusrNomb,inlocNomb,Rsocial,Nit
        ) AS sumcxc
        PIVOT
        (
            SUM(ACuenta)
            FOR Estado IN ([cred],[cont])
        ) AS pivotable
        --WHERE adusrCusr = 46
        GROUP BY cxcTrCcto,Cliente,adusrCusr,adusrNomb,inlocNomb
        ORDER BY adusrCusr
        "
      ));
    // dd($movimientos1);
    // dd($movimientos2);
    foreach ($movimientos1 as $key => $value) {
      // dd($value->id_usuario_1);
      foreach ($movimientos2 as $i => $j) {
        // dd($value->id_usuario_1 == $j->id_usuario_2);
        if ($value->id_usuario_1 == $j->id_usuario_2 && $value->local_1 == $j->local_2) {
          $test[$value->id_usuario_1.$value->local_1][] = ['nomb_cliente_2' => $j->nomb_cliente_2, 'importeCXC_2' => $j->importeCXC_2, 'importeCXC_2' => $j->importeCXC_2, 'cont_2' => $j->cont_2, 'cred_2' => $j->cred_2, 'saldo_2' => $j->saldo_2];
        }
      }
    }
    // dd($test[3]);
    $array = [];
    foreach ($movimientos1 as $key => $value) {
      $array[] = ['id_usuario_1' => $value->id_usuario_1, 'nomb_user_1' => $value->nomb_user_1, 'local_1' => $value->local_1, 'importeCXC_1' => $value->importeCXC_1, 'cont_1' => $value->cont_1, 'cred_1' => $value->cred_1, 'saldo_1' => $value->saldo_1, 'vista1' =>$test[$value->id_usuario_1.$value->local_1]];
    }
    // dd($array[1]);
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
        adusrNomb,
        dif_dias_1,
        dif_dias_2
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
          adusrNomb,
          DATEDIFF(DAY,venta.vtvtaFtra,cobros.liqXCFtra) AS dif_dias_1,
          DATEDIFF(DAY,venta.vtvtaFtra,'" . $fecha_cons . "') AS dif_dias_2
          FROM cxcTr
          LEFT JOIN cptra ON cptraNtrI = cxcTrNtrI
          JOIN bd_admOlimpia.dbo.adusr ON adusrCusr = cxcTrCcbr AND adusrMdel = 0
          LEFT JOIN
          (
            SELECT *
            FROM vtVta
            LEFT JOIN imLvt ON imlvtNvta = vtvtaNtra
            WHERe vtvtaMdel = 0
            AND vtvtaFtra <= '" . $fecha . "'
          )AS venta ON (imLvtNvta = cxcTrNtrI) AND imLvtMdel = 0
          LEFT JOIN
          (
            SELECT liqdCNtcc, liqdCAcmt AS AcuentaF, liqXCFtra, liqXCGlos--,SUM(liqdCAcmt) as AcuentaF
            FROM liqdC
            JOIN liqXC ON liqdCNtra = liqXCNtra
            WHERE liqXCMdel = 0 
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
      return view('reports.vista.cuentasporcobrartotal', compact('array'));
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
