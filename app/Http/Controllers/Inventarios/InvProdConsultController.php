<?php

namespace App\Http\Controllers\Inventarios;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use DataTables;

class InvProdConsultController extends Controller
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
        if(Auth::user()->tienePermiso(26, 1)){
            /*$qprod =
            "WITH produ AS( 
                SELECT 
                inproCpro as prod,
                inproNomb as descrip,
                inproCodi as BarCod, 
                inproPcod as BarCodPie,
                inumeAbre as um,
                inumeDesc  as um_desc,
                maconNomb as marca
                FROM inpro
                LEFT JOIN inume ON inumeCume = inproCumb 
                LEFT JOIN macon ON inproMarc = CAST(MaconCcon as varchar)+ '|' + CAST(MaconItem as varchar)
                WHERE inproMdel = 0
            )
            SELECT *  
            FROM produ
            ";
            $prod = DB::connection('sqlsrv')->select(DB::raw($qprod));*/
            return view('inventarios.consultaprods2');
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
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $qprod =
        "WITH produ AS( 
            SELECT 
            inproCpro as prod,
            inproNomb as descrip,
            inproCodi as BarCod, 
            inproPcod as BarCodPie,
            inumeAbre as um,
            inumeDesc  as um_desc,
            maconNomb as marca,
            CONVERT(VARCHAR, cast((vtLidPrco) as money),1) as retail
            FROM inpro
            LEFT JOIN inume ON inumeCume = inproCumb 
            LEFT JOIN macon ON inproMarc = CAST(MaconCcon as varchar)+ '|' + CAST(MaconItem as varchar)
            LEFT JOIN vtLid on inproCpro = vtLidCpro
            WHERE inproMdel = 0 and vtLidClis = 1
        )
        SELECT *  
        FROM produ
        WHERE prod LIKE '%".$request->input('buscar')."%'
        OR descrip LIKE '%".$request->input('buscar')."%'
        OR BarCod LIKE '%".$request->input('buscar')."%'
        OR marca LIKE '%".$request->input('buscar')."%'
        ";
        $prod = DB::connection('sqlsrv')->select(DB::raw($qprod));
        //return response()->json($prod); 
        return DataTables::of($prod)->with(['prod' => $prod])->make();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function retail()
    {
        //
    }

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
        if(Auth::user()->tienePermiso(26, 1)){
            return view('inventarios.consultaprods2');
        }
        return redirect()->back();
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
