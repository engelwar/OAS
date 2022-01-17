<?php

namespace App\Http\Controllers\Inventarios;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use App\TomInvProd;
use App\TomInvTom;
use DataTables;

class TomInvReqController extends Controller
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
        //if(Auth::user()->tienePermiso(25, 1)){
            return view('inventarios.tominvreq');
        //}
        //return redirect()->back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function prods(Request $request){
        $filtro = "1=1";
        //return dd($request->cont_filt);
        if($request->cont_filt == "cont_fis"){
            $falt = "faltante";
            $sobr = "sobrante";
        }
        else if($request->cont_filt == "cont1"){
            $falt = "faltante1";
            $sobr = "sobrante1";
        }
        else if($request->cont_filt == "cont2"){
            $falt = "faltante2";
            $sobr = "sobrante2";
        }
        else if($request->cont_filt == "cont3"){
            $falt = "faltante3";
            $sobr = "sobrante3";
        }

        if($request->fmin !== null && $request->fmax !== null){
            $filtro .= " AND ".$falt." BETWEEN ".$request->fmin." AND ".$request->fmax."";
        }
        else if($request->fmin !== null && $request->fmax === null){
            $filtro .= " AND ".$falt." >= ".$request->fmin;"";
        }
        else if($request->fmax !== null && $request->fmin === null){
            $filtro .= " AND ".$falt." <= ".$request->fmax;"";
        }

        if($request->smin !== null && $request->smax !== null){
            $filtro .= " AND ".$sobr." BETWEEN ".$request->smin." AND ".$request->smax."";
        }
        else if($request->smin !== null && $request->smax === null){
            $filtro .= " AND ".$sobr." >= ".$request->smin;"";
        }
        else if($request->smax !== null && $request->smin === null){
            $filtro .= " AND ".$sobr." <= ".$request->smax;"";
        }
        //return dd($filtro);
        $tom = TomInvTom::find($request->tom_id);
        $suc_id ="WHERE toms.suc_id = ".$tom->suc_id." AND toms.id = ".$tom->id."";
        $cunid_id ="WHERE cunid = ".$tom->suc_id."";
        //$db = 'oas';
        $db = env('DB_DATABASE');
        $qprod = 
        "WITH prods as
        (
            SELECT *
            FROM OPENQUERY(OASSERVER, '
			SELECT prod, descrip, um, nuevo, suc_id, MAX(sucursal) as sucursal, 
			CONVERT(SUM(IFNULL(Conteo1,0)),char) as Conteo1,
			CONVERT(SUM(IFNULL(Conteo2,0)),char) as Conteo2,
			CONVERT(SUM(IFNULL(Conteo3,0)),char) as Conteo3,
			CONVERT(SUM(IFNULL(IFNULL(Conteo3, Conteo2), IFNULL(Conteo1,0))),char) as C3,
			GROUP_CONCAT(DISTINCT nro SEPARATOR '' - '') as prod_ubi_nros,
            COUNT(nro) as contado
			FROM(
                SELECT 
                prod, prods.descrip, um, nuevo, 
                prod_ubi.nro, suc_id, unidads.nombre as sucursal,
                SUM(CASE WHEN conts.conteo_id = 1 THEN prods.cantidad END) AS Conteo1,
                SUM(CASE WHEN conts.conteo_id = 2 THEN prods.cantidad END) AS Conteo2,
                SUM(CASE WHEN conts.conteo_id = 3 THEN prods.cantidad END) AS Conteo3
                FROM ".$db.".tom_inv_prods as prods
                JOIN ".$db.".tom_inv_conts as conts ON conts.id = prods.cont_id
                JOIN ".$db.".tom_inv_toms as toms ON toms.id = conts.tom_inv_tom_id
                JOIN ".$db.".unidads ON unidads.id = toms.suc_id
                LEFT JOIN ".$db.".tom_inv_prod_ubis as prod_ubi ON prod_ubi_id = prod_ubi.id
                ".$suc_id."
                GROUP BY prod,  prods.descrip, um, nuevo, prod_ubi.nro, suc_id, unidads.nombre
				) as produc
			GROUP BY prod, descrip, um, nuevo, suc_id
            ') as produ
        ), prod AS
        (
            SELECT ISNULL(prods.prod,insalCpro) as prod, ISNULL(prods.descrip, inproNomb) as descrip,
            ISNULL(prods.um, inumeAbre) as um, prod_ubi_nros,
            CASE nuevo WHEN 0 THEN 'DUAL'WHEN 1 THEN 'NUEVO'WHEN 2 THEN 'ODOO' END as tipo, 
            CONVERT(varchar, CAST(ISNULL(costo,0) as decimal(20,4))) as costo,ISNULL(stock,0) as stock,
            ISNULL(Conteo1,0) as Conteo1, 
            CASE WHEN ISNULL(Conteo1,0)-ISNULL(stock,0) < 0 THEN ABS(ISNULL(Conteo1,0)-ISNULL(stock,0)) ELSE 0 END as faltante1, 
            CASE WHEN ISNULL(Conteo1,0)-ISNULL(stock,0) > 0 THEN ABS(ISNULL(Conteo1,0)-ISNULL(stock,0)) ELSE 0 END as sobrante1,
            ISNULL(Conteo2,0) as Conteo2, 
            CASE WHEN ISNULL(Conteo2,0)-ISNULL(stock,0) < 0 THEN ABS(ISNULL(Conteo2,0)-ISNULL(stock,0)) ELSE 0 END as faltante2, 
            CASE WHEN ISNULL(Conteo2,0)-ISNULL(stock,0) > 0 THEN ABS(ISNULL(Conteo2,0)-ISNULL(stock,0)) ELSE 0 END as sobrante2,
            ISNULL(Conteo3,0) as Conteo3, 
            CASE WHEN ISNULL(Conteo3,0)-ISNULL(stock,0) < 0 THEN ABS(ISNULL(Conteo3,0)-ISNULL(stock,0)) ELSE 0 END as faltante3, 
            CASE WHEN ISNULL(Conteo3,0)-ISNULL(stock,0) > 0 THEN ABS(ISNULL(Conteo3,0)-ISNULL(stock,0)) ELSE 0 END as sobrante3,
            suc_id, sucursal, alm, contado,
            ISNULL(C3,0) as contfis,
            CASE WHEN ISNULL(C3,0)-ISNULL(stock,0) < 0 THEN ABS(ISNULL(C3,0)-ISNULL(stock,0)) ELSE 0 END as faltante, 
            CASE WHEN ISNULL(C3,0)-ISNULL(stock,0) > 0 THEN ABS(ISNULL(C3,0)-ISNULL(stock,0)) ELSE 0 END as sobrante 
            FROM prods
            FULL OUTER JOIN 
            (
                SELECT insalCpro, SUM(insalCanB) as stock, cunid, alm, AVG(costo) as costo
                FROM 
                (
                    SELECT insalCpro, cast(insalCanB as decimal) as insalCanB, insalCalm,
                    CASE  
                    WHEN insalCalm IN (7,10) THEN 'BALLIVIAN'
                    WHEN insalCalm IN (4,13) THEN 'HANDAL'
                    WHEN insalCalm IN (5,29) THEN 'CALACOTO'
                    WHEN insalCalm IN (6,30) THEN 'MARISCAL'
                    WHEN insalCalm IN (40,47) THEN 'AC2'
                    WHEN insalCalm IN (43) THEN 'PLANTA EL ALTO'
                    END AS alm,
                    CASE  
                    WHEN insalCalm IN (7,10) THEN 2
                    WHEN insalCalm IN (4,13) THEN 3
                    WHEN insalCalm IN (5,29) THEN 5
                    WHEN insalCalm IN (6,30) THEN 4
                    WHEN insalCalm IN (40,47) THEN 6
                    WHEN insalCalm IN (43) THEN 7 
                    END AS cunid,
                    insalCupb as costo
                    FROM DUALBIZ_SERVER.bd_olimpia.dbo.insal 
                    WHERE insalCalm IN (4,5,6,7,10,13,29,30,40,43,46,47)
                ) as stock
                ".$cunid_id."
                GROUP BY insalCpro, cunid, alm
            ) as stock
            ON stock.insalCpro = prods.prod AND stock.cunid = prods.suc_id
            LEFT JOIN 
            (
                SELECT inproCpro, inproNomb, inumeAbre 
                FROM inpro 
                JOIN inume ON inumeCume = inproCumb
                WHERE inproMDel = 0
            ) as inpro 
            ON insalCpro = inproCpro
        ) 
        SELECT * 
        FROM prod
        WHERE ".$filtro."
        ORDER BY prod
        ";
        $prods = DB::connection('DUALBIZ_SERVER')->select(DB::raw($qprod));
        return DataTables::of($prods)->make(); 
    }
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $db = env('DB_DATABASE');
        $qprod = 
        "WITH prods as
        (
            SELECT *
            FROM OPENQUERY(OASSERVER, '
			SELECT prod, descrip, um, nuevo, suc_id, MAX(sucursal) as sucursal, 
			CONVERT(SUM(IFNULL(Conteo1,0)),char) as Conteo1,
			CONVERT(SUM(IFNULL(Conteo2,0)),char) as Conteo2,
			CONVERT(SUM(IFNULL(Conteo3,0)),char) as Conteo3,
			CONVERT(SUM(IFNULL(IFNULL(Conteo3, Conteo2), IFNULL(Conteo1,0))),char) as C3,
			GROUP_CONCAT(DISTINCT nro SEPARATOR '' - '') as prod_ubi_nros,
            COUNT(nro) as contado
			FROM(
                SELECT 
                prod, prods.descrip, um, nuevo, 
                prod_ubi.nro, suc_id, unidads.nombre as sucursal,
                SUM(CASE WHEN conts.conteo_id = 1 THEN prods.cantidad END) AS Conteo1,
                SUM(CASE WHEN conts.conteo_id = 2 THEN prods.cantidad END) AS Conteo2,
                SUM(CASE WHEN conts.conteo_id = 3 THEN prods.cantidad END) AS Conteo3
                FROM ".$db.".tom_inv_prods as prods
                JOIN ".$db.".tom_inv_conts as conts ON conts.id = prods.cont_id
                JOIN ".$db.".tom_inv_toms as toms ON toms.id = conts.tom_inv_tom_id
                JOIN ".$db.".unidads ON unidads.id = toms.suc_id
                LEFT JOIN ".$db.".tom_inv_prod_ubis as prod_ubi ON prod_ubi_id = prod_ubi.id
                GROUP BY prod,  prods.descrip, um, nuevo, prod_ubi.nro, suc_id, unidads.nombre
				) as produc
			GROUP BY prod, descrip, um, nuevo, suc_id
            ') as produ
        )
        SELECT ISNULL(prods.prod,insalCpro) as prod, prods.descrip,prods.um, prod_ubi_nros,
        CASE nuevo WHEN 0 THEN 'DUAL'WHEN 1 THEN 'NUEVO'WHEN 2 THEN 'ODOO' END as tipo, 
        CONVERT(varchar, CAST(ISNULL(costo,0) as decimal(20,4))) as costo,ISNULL(stock,0) as stock,
		ISNULL(Conteo1,0) as Conteo1, 
        CASE WHEN ISNULL(Conteo1,0)-ISNULL(stock,0) < 0 THEN ABS(ISNULL(Conteo1,0)-ISNULL(stock,0)) ELSE 0 END as faltante1, 
        CASE WHEN ISNULL(Conteo1,0)-ISNULL(stock,0) > 0 THEN ABS(ISNULL(Conteo1,0)-ISNULL(stock,0)) ELSE 0 END as sobrante1,
        ISNULL(Conteo2,0) as Conteo2, 
        CASE WHEN ISNULL(Conteo2,0)-ISNULL(stock,0) < 0 THEN ABS(ISNULL(Conteo2,0)-ISNULL(stock,0)) ELSE 0 END as faltante2, 
        CASE WHEN ISNULL(Conteo2,0)-ISNULL(stock,0) > 0 THEN ABS(ISNULL(Conteo2,0)-ISNULL(stock,0)) ELSE 0 END as sobrante2,
        ISNULL(Conteo3,0) as Conteo3, 
        CASE WHEN ISNULL(Conteo3,0)-ISNULL(stock,0) < 0 THEN ABS(ISNULL(Conteo3,0)-ISNULL(stock,0)) ELSE 0 END as faltante3, 
        CASE WHEN ISNULL(Conteo3,0)-ISNULL(stock,0) > 0 THEN ABS(ISNULL(Conteo3,0)-ISNULL(stock,0)) ELSE 0 END as sobrante3,
        suc_id, sucursal, C3 as contfis,
        alm, contado,
        CASE WHEN ISNULL(C3,0)-ISNULL(stock,0) < 0 THEN ABS(ISNULL(C3,0)-ISNULL(stock,0)) ELSE 0 END as faltante, 
        CASE WHEN ISNULL(C3,0)-ISNULL(stock,0) > 0 THEN ABS(ISNULL(C3,0)-ISNULL(stock,0)) ELSE 0 END as sobrante 
        FROM prods
        FULL OUTER JOIN 
        (
            SELECT insalCpro, SUM(insalCanB) as stock, cunid, alm, AVG(costo) as costo
            FROM 
            (
                SELECT insalCpro, cast(insalCanB as decimal) as insalCanB, insalCalm,
                CASE  
                WHEN insalCalm IN (7,10) THEN 'BALLIVIAN'
                WHEN insalCalm IN (4,13) THEN 'HANDAL'
                WHEN insalCalm IN (5,29) THEN 'CALACOTO'
                WHEN insalCalm IN (6,30) THEN 'MARISCAL'
                WHEN insalCalm IN (40,47) THEN 'AC2'
                WHEN insalCalm IN (43) THEN 'PLANTA EL ALTO'
                END AS alm,
                CASE  
                WHEN insalCalm IN (7,10) THEN 2
                WHEN insalCalm IN (4,13) THEN 3
                WHEN insalCalm IN (5,29) THEN 5
                WHEN insalCalm IN (6,30) THEN 4
                WHEN insalCalm IN (40,47) THEN 6
                WHEN insalCalm IN (43) THEN 7 
				END AS cunid,
                insalCupb as costo
                FROM DUALBIZ_SERVER.bd_olimpia.dbo.insal 
                WHERE insalCalm IN (4,5,6,7,10,13,29,30,40,43,46,47)
            ) as stock
            GROUP BY insalCpro, cunid, alm
        ) as stock
        ON stock.insalCpro = prods.prod AND stock.cunid = prods.suc_id
        ORDER BY prod
        ";
        $prods = DB::connection('DUALBIZ_SERVER')->select(DB::raw($qprod));
        return dd($prods);
        return DataTables::of($prods)->make();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $toma = TomInvTom::find($id);
        return view('inventarios.vista.tominvreq', compact('toma'));
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

    public function pdf(Request $request){
        $data = $request->data;
        $pdf = \PDF::loadView('inventarios.pdf', compact('data'))
        ->setOrientation('landscape')
        ->setPaper('letter')
        ->setOption('footer-right','Pag [page] de [toPage]')
        ->setOption('footer-font-size',8)
        ->setOption('margin-left','5')
        ->setOption('margin-right','5')
        ->setOption('margin-top','10')
        ->setOption('margin-bottom','20');
        return $pdf->download('TomaInventario.pdf');
    }
}
