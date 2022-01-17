<?php

namespace App\Http\Controllers\Inventarios;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\TomInvProd;
use App\TomInvCont;
use DataTables;

class TomInvProdUbiController extends Controller
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
       return view('inventarios.tominvxubi');
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
    public function prods(Request $request)
    {
        $fdesde = $request->fdesde;
        $fhasta = $request->fhasta;
        $sdesde = $request->sdesde;
        $shasta = $request->shasta;        
        //$prods = TomInvProd::with(['Conts'])->get();
        $modulos = $request->modulos;
        $mod_div = [];
        foreach ($modulos as $key => $m) {
            $mod_div[] = "SUM(CASE WHEN prod_ubi_id = ".$m['prod_ubi_id']." THEN prods.cantidad END) AS Mod".$m['prod_ubi_id']."";
        }
        $db = env('DB_DATABASE');
        //$stock = join(",",$stock);
        //return response()->json($stock); 
        $tom = TomInvCont::find($request->cont_id)->toma;
        $qprod = 
        "WITH prods AS
        (
            SELECT * 
            FROM OPENQUERY(OASSERVER, '
                SELECT  
                prods.prod,
                MAX(prods.marca) AS marca,
                prods.descrip,
                MAX(prods.barcod) AS barcod,
                prods.um,
                ".implode(",", $mod_div).",
                CASE WHEN prods.nuevo = 0 THEN ''DUALBIZ''
                WHEN prods.nuevo = 1 THEN ''NUEVO''
                WHEN prods.nuevo = 2 THEN ''ODOO''
                END AS nuevo,
                SUM(IFNULL(prods.cantidad,0)) as total,
                0 as faltante, 
                0 as sobrante 
                FROM ".$db.".tom_inv_prods as prods
                WHERE cont_id = ".$request->cont_id."
                GROUP BY prods.prod, prods.descrip,
                prods.um, prods.nuevo
            ') as produ
        )
        SELECT * 
        FROM prods
        LEFT JOIN 
        (
            SELECT insalCpro, SUM(insalCanB) as stock, cunid, alm, CONVERT(varchar,AVG(costo),1) as costo
            FROM(
                SELECT insalCpro, cast(insalCanB as decimal) as insalCanB, insalCalm,
                CASE  
                WHEN insalCalm IN (7,10) THEN 'BALLIVIAN'
                WHEN insalCalm IN (4,13) THEN 'HANDAL'
                WHEN insalCalm IN (5,29) THEN 'CALACOTO'
                WHEN insalCalm IN (6,30) THEN 'MARISCAL'
                WHEN insalCalm IN (40,47) THEN 'AC2'
                WHEN insalCalm IN (43) THEN 'PLANTA EL ALTO'
                ELSE '0'
                END 
                AS alm,
                CASE  
                WHEN insalCalm IN (7,10) THEN 2
                WHEN insalCalm IN (4,13) THEN 3
                WHEN insalCalm IN (5,29) THEN 5
                WHEN insalCalm IN (6,30) THEN 4
                WHEN insalCalm IN (40,47) THEN 6
                WHEN insalCalm IN (43) THEN 7
                ELSE 0 END
                AS cunid,
                CAST(insalCupb as money) as costo
                FROM insal 
                WHERE insalCalm IN (4,5,6,7,10,13,29,30,40,43,46,47)  
            ) as sto
            WHERE cunid = ".$tom->suc_id."
            GROUP BY insalCpro, cunid, alm
        ) as stock
        ON stock.insalCpro = prods.prod
        ";
        $prods = DB::connection('DUALBIZ_SERVER')->select(DB::raw($qprod));
        return DataTables::of($prods)->make();
    }
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $modulos = "SELECT prod_ubi_id, nro 
        FROM tom_inv_prods 
        JOIN tom_inv_prod_ubis as ubi ON ubi.id = tom_inv_prods.prod_ubi_id 
        WHERE cont_id = ".$id." GROUP BY prod_ubi_id ORDER BY prod_ubi_id";
        $modulos = DB::select(DB::raw($modulos));
        $titles = [['data'=>'prod','title'=>'CODIGO'],
        ['data'=>'descrip','title'=>'Descripcion'],
        ['data'=>'um','title'=>'UM'],
        ['data'=>'barcod','title'=>'Cod.Barras'],
        ['data'=>'nuevo','title'=>'Tipo'],
        ['data'=>'costo','title'=>'Costo Dual'],
        ['data'=>'stock','title'=>'Stock Dual']];
        foreach ($modulos as $key => $m) {
            $titles[] = ['data'=>"Mod".$m->prod_ubi_id, "title"=>"Mod".$m->nro];
        }
        $titles[] =  ['data'=>'total','title'=>'total'];
        $titles[] =  ['data'=>'faltante','title'=>'faltante'];
        $titles[] =  ['data'=>'sobrante','title'=>'sobrante'];
        $cont = TomInvCont::find($id);

        return view('inventarios.vista.tominvxubi', compact('cont', 'titles', 'modulos'));
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
