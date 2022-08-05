<?php

namespace App\Http\Controllers\Inventarios;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use DB;
use Auth;

class InvProdConsultDetalleController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    //
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
    //
    $detallequery = "
        SELECT 
            inproCpro as prod,
            -- inproNomb as descrip,
            -- inproCodi as BarCod, 
            -- inproPcod as BarCodPie,
            -- inumeAbre as um,
            -- inumeDesc  as um_desc,
            -- maconNomb as marca,
            CONVERT(VARCHAR, cast((vtLidPrco) as money),1) as retail
            FROM inpro
            LEFT JOIN inume ON inumeCume = inproCumb 
            LEFT JOIN macon ON inproMarc = CAST(MaconCcon as varchar)+ '|' + CAST(MaconItem as varchar)
            LEFT JOIN vtLid on inproCpro = vtLidCpro
            WHERE inproMdel = 0 and vtLidClis = 40
			AND inproCpro = '".$request->id."'";
    $detalle = DB::connection('sqlsrv')->select(DB::raw($detallequery));
    return response()->json(['detalle' => $detalle]);
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
