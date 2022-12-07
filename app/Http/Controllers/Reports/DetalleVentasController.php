<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DetalleVentasExport;

class DetalleVentasController extends Controller
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
    return view('reports.detalleventas');
    if (Auth::user()->tienePermiso(5, 1)) {
      
    }
    return redirect()->back();
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
    $fini = $request->fini;
    $ffin = $request->ffin;
    $sql_query = "
      SELECT
      vtvtaNtra,
      CONVERT(varchar,vtvtaFtra,103) as fecha,
      adusrNomb,
      inalmNomb,
      CONVERT(varchar, CAST(vtvtaImpT as decimal(10,2)),1) as imptotal,
      CONVERT(varchar, CAST(vtvtaDesT as decimal(10,2)),1) as destotal,
      CONVERT(varchar, CAST(vtvtaImpT - vtvtaDesT as decimal(10,2)),1) as total,
      ISNULL(imLvtNrfc,'-') AS factura
      FROM vtVta
      LEFT JOIN imLvt ON imlvtNvta = vtvtaNtra
      LEFT JOIN inalm ON inalmCalm = vtvtaCalm
      LEFT JOIN bd_admOlimpia.dbo.adusr ON adusrCusr = vtvtaCusr
      WHERE vtvtaMdel = 0
      AND vtvtaFtra BETWEEN '01/12/2022' AND '04/12/2022'
      AND vtvtaNtra IN ('1010246360','1010246361')
      ORDER BY vtvtaFtra
    ";
    $query = DB::connection('sqlsrv')->select(DB::raw($sql_query));
    return view('reports.vista.detalleventas', compact('query'));
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
