<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\StockExport;
use App\TempStockParam;
class StockVentaController extends Controller
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
        if(Auth::user()->tienePermiso(5, 1)){
            $alm_q = 
            "SELECT 
            CASE 
            WHEN inalmCalm IN (40,47) THEN 'AC2'
            WHEN inalmCalm IN (43) THEN 'Planta'
            WHEN inalmCalm IN (4,13) THEN 'Handal'
            WHEN inalmCalm IN (7,10) THEN 'Ballivian'
            WHEN inalmCalm IN (6,30) THEN 'Mariscal'
            WHEN inalmCalm IN (5,29) THEN 'Calacoto'
            WHEN inalmCalm IN (43) THEN 'Produccion'
            WHEN inalmCalm IN (54) THEN 'VMovil1'
            ELSE 'Sin Grupo'
            END as grupo,
            CASE 
            WHEN inalmCalm IN (4,5,6,7,10,13,
                29,30,40,43,47) THEN 1
            ELSE 0
            END as estado,
            inalmCalm, 
            inalmNomb 
            FROM inalm 
            WHERE inalmMdel = 0 AND inalmStat = 1 AND inalmCalm NOT IN (42, 44, 51,36,38,52)
            ORDER BY estado DESC, inalmNomb";

            $almacen = DB::connection('sqlsrv')->select(DB::raw($alm_q));
            $almacen_grupo = [];
            foreach ($almacen as $key => $value) {
                if(!array_key_exists($value->grupo,$almacen_grupo))
                {
                    $almacen_grupo[$value->grupo]=[$almacen[$key]];
                }
                else{
                    $almacen_grupo[$value->grupo][]=$almacen[$key];
                } 
            }
            return view('reports.stockventa', compact('almacen', 'almacen_grupo'));
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
        if(!Auth::user()->tienePermiso(5,9)){
            $almxu = TempStockParam::where('user_id',Auth::user()->id)->get('alm_id');
            $almxua = [];
            foreach ($almxu as $key => $value) {
                $almxua[] = $value->alm_id;
            }
            if($almxua){
                $almacenes = $almxua;
            }
            else{
                return redirect()->back(); 
            }
        }
        else{
            $almacenes = $request->almacen;
        }

        //return dd(implode("+",$alma_total));
        // $pvp_sql = "";
        $pvp = false;
        $titulos=
        [
            ['name'=>'categoria', 'data'=>'categoria', 'title'=>'Categoria', 'tip'=>'filtro'],
            ['name'=>'codigo', 'data'=>'codigo', 'title'=>'Codigo', 'tip'=>'filtro'],
            ['name'=>'descripcion', 'data'=>'descripcion', 'title'=>'Descripcion', 'tip'=>'filtro'],
            ['name'=>'umprod', 'data'=>'umprod', 'title'=>'U.M.', 'tip'=>'filtro_select'],  
        ];
        $titulos_excel=
        [
            'Categoria',
            'Codigo',
            'Descripcion',
            'U.M,',          
        ];
        $ffin = date("d-m-Y",strtotime(date('d-m-Y')."- 1 days"));
        $ffin2 = date("d/m/Y");
        if ($request->fecha_fin)
        {
            $ffin2 = date("d/m/Y", strtotime($request->fecha_fin));
        }
        $categ = "";
        if($request->categoria)
        {
            $categ = "AND   marc.maconNomb LIKE '%".$request->categoria."%'";
        }
        $prod= "";
        if($request->producto)
        {
            $prod = "AND (inpro.inproCpro LIKE '%".$request->producto."%'
            OR inpro.inproNomb LIKE '%".$request->producto."%')";
        }
        $stock = "";
        $stocki="";
        if($request->stock0==null)
        {
            $stock = "AND (stocks.Total IS NOT NULL)";
            $stocki = "AND stocks.Total <> 0";

        } 
        if($request->selectAlmacen == 1){
            $nombAlmacen = 'Ballivian';
            $idAlmacen = 7;
            $grup_tit2 = "ISNULL([7],0)+ISNULL([10],0) as [Ballivian]";
            $grup_t2 = "CAST(ISNULL([Ballivian],0) as varchar)";
        }
        elseif($request->selectAlmacen == 2){
            $nombAlmacen = 'Handal';
            $idAlmacen = 4;
            $grup_tit2 = "ISNULL([4],0)+ISNULL([13],0) as [Handal]";
            $grup_t2 = "CAST(ISNULL([Handal],0) as varchar)";
        }
        elseif($request->selectAlmacen == 3){
            $nombAlmacen = 'Mariscal';
            $idAlmacen = 6;
            $grup_tit2 = "ISNULL([6],0)+ISNULL([30],0) as [Mariscal]";
            $grup_t2 = "CAST(ISNULL([Mariscal],0) as varchar)";
        }
        elseif($request->selectAlmacen == 4){
            $nombAlmacen = 'Calacoto';
            $idAlmacen = 5;
            $grup_tit2 = "ISNULL([5],0)+ISNULL([29],0) as [Calacoto]";
            $grup_t2 = "CAST(ISNULL([Calacoto],0) as varchar)";
        }

        $titulos[] = ['name'=>$nombAlmacen, 'data'=>$nombAlmacen, 'title'=>$nombAlmacen, 'tip'=>'decimal'];
        $titulos[] = ['name'=>'I-E-T', 'data'=>'I-E-T', 'title'=>'I.E.T.', 'tip'=>'decimal'];
        $titulos[] = ['name'=>'Ventas', 'data'=>'Ventas', 'title'=>'Ventas', 'tip'=>'decimal'];
        $titulos[] = ['name'=>'Saldo', 'data'=>'Saldo', 'title'=>'Saldo', 'tip'=>'decimal'];
        $grup_tit = [];
        $grup_t = [];
        $temp2 = [];
        foreach (unserialize($request->grupos) as $key => $value) {
            if($key == 'Sin Grupo'){
                foreach ($value as $k => $v) {
                    if(array_search($v->inalmCalm,$almacenes))
                    {
                        $grup_tit[] = "ISNULL([".$v->inalmCalm."],0) as [".$v->inalmCalm."]";
                        $grup_t[] = "CAST(ISNULL([".$v->inalmCalm."],0) as varchar) as [".$v->inalmNomb."]";
                        $titulos[] = ['name'=>$v->inalmNomb, 'data'=>$v->inalmNomb, 'title'=>$v->inalmNomb, 'tip'=>'decimal'];
                        $titulos_excel[] = $v->inalmNomb;
                    }                    
                }              
            } 
            else{
                $temp= [];
                foreach ($value as $k => $v) {
                    if($key != $nombAlmacen){
                        if(array_search($v->inalmCalm,$almacenes) !== false)
                        {
                            $temp[] = "ISNULL([".$v->inalmCalm."],0)";
                        }
                    }
                }   
                if($temp != null)
                {
                    $grup_tit[] = implode("+",$temp)." as [".$key."]";
                    $grup_t[] = "CAST(ISNULL([".$key."],0) as varchar) as [".$key."]";
                    $temp2[] = "stocks.".$key;

                    $titulos[] = ['name'=>$key, 'data'=>$key, 'title'=>$key, 'tip'=>'decimal'];
                    $titulos_excel[] = $key;
                } 
            }
        }
        // return dd($request->all());
        $alma = [];
        $alma_total = [];
        foreach ($almacenes as $value) {
            $alma[] = "[".$value."]";
            $alma_total[] ="ISNULL([".$value."],0)";;
        }
        $query = "
        SELECT 
        marc.maconNomb as categoria, 
        inpro.inproCpro as codigo, 
        inpro.inproNomb as descripcion, 
        umpro.inumeAbre as umprod, 

        (
            SELECT
            ".$grup_t2." 
            FROM ( SELECT * FROM inpro ) as inpro2
            LEFT JOIN ( SELECT intrdCpro, 
                ".$grup_tit2."
                FROM ( SELECT intrdCpro, intraCalm, SUM(intrdCanb) as cant 
                    FROM intra JOIN intrd ON intraNtra = intrdNtra 
                    WHERE intraMdel = 0 AND intrdMdel = 0 AND intraFtra <= '".$ffin."' 
                    GROUP BY intrdCpro, intraCalm ) as sotck pivot ( SUM(cant) for intraCalm IN (".implode(",",$alma).") ) as ptv ) as stocks ON stocks.intrdCpro = inpro2.inproCpro ".$stocki."
            WHERE inproMdel = 0 AND inproStat = 0 
            AND inpro2.inproCpro = inpro.inproCpro
        )as ".$nombAlmacen.",

        (
            select (select IsNull(SUM(intrdCanT),0 )
            from intra
            JOIN intrd on intrdNtra = intraNtra
            where intraMdel = 0 
            AND intrdMdel = 0
            and intraNtrI = 0
            and intraCalm = ".$idAlmacen."
            and intrdCpro = inpro.inproCpro
            AND intraFtra = '".$ffin2."'
            )
            +
            (SELECT
            IsNull(SUM(intpdCanB), 0)
            FROM intpd
            LEFT JOIN intrp ON intrpNtrp = intpdNtrp AND intpdMdel = 0
            JOIN inalm as almdes ON almdes.inalmCalm = intrpCads
            JOIN bd_admOlimpia.dbo.adusr as resp ON resp.adusrCusr = intrpCres
            LEFT JOIN malog ON maLogNtra = CAST(intrpNtrp as varchar) AND malogTtra = 1 AND malogCprg IN (256, 793) 
            LEFT JOIN bd_admOlimpia.dbo.adusr as soli ON soli.adusrCusr = malogCusr
            WHERE intpdMdel = 0
            AND almdes.inalmCalm = ".$idAlmacen."
            AND intpdCpro = inpro.inproCpro
            AND intrpFtrp = '".$ffin2."'
            )
        ) as [I-E-T],

        (
            select 
            IsNull(SUM(vtvtdCant), 0)
            from vtVta as a
            join vtVtd on vtvtaNtra = vtvtdNtra
            where vtvtaFtra = '".$ffin2."'
            AND vtvtdCpro = inpro.inproCpro
            AND vtvtaCalm = ".$idAlmacen."
            AND vtvtdMdel = 0
        )as Ventas,
        (
            SELECT
            ".$grup_t2." 
            FROM ( SELECT * FROM inpro ) as inpro2
            LEFT JOIN ( SELECT intrdCpro, 
                ".$grup_tit2."
                FROM ( SELECT intrdCpro, intraCalm, SUM(intrdCanb) as cant 
                    FROM intra JOIN intrd ON intraNtra = intrdNtra 
                    WHERE intraMdel = 0 AND intrdMdel = 0 AND intraFtra <= '".$ffin2."'
                    GROUP BY intrdCpro, intraCalm ) as sotck pivot ( SUM(cant) for intraCalm IN (".implode(",",$alma).") ) as ptv ) as stocks ON stocks.intrdCpro = inpro2.inproCpro ".$stocki."
            WHERE inproMdel = 0 AND inproStat = 0 
            AND inpro2.inproCpro = inpro.inproCpro
        )as Saldo,

        ".implode(",",$grup_t)."
        FROM ( SELECT * FROM inpro ) as inpro 
        LEFT JOIN inume as umpro ON umpro.inumeCume = inpro.inproCumb 
        LEFT JOIN ( SELECT convert(varchar,maconCcon)+'|'+convert(varchar,maconItem) as maconMarc, maconNomb 
            FROM macon 
            WHERE maconCcon = 113 ) as marc ON inpro.inproMarc = marc.maconMarc 
        LEFT JOIN ( SELECT intrdCpro, 
        ".implode(",",$grup_tit)."
            FROM ( SELECT intrdCpro, intraCalm, SUM(intrdCanb) as cant 
                FROM intra JOIN intrd ON intraNtra = intrdNtra 
                WHERE intraMdel = 0 AND intrdMdel = 0 AND intraFtra <= '".$ffin2."' 
                GROUP BY intrdCpro, intraCalm ) as sotck pivot ( SUM(cant) for intraCalm IN ([39],[46],[47],[40],[7],[10],[5],[29],[55],[4],[13],[6],[30],[43],[45],[54]) ) as ptv ) as stocks ON stocks.intrdCpro = inpro.inproCpro ".$stocki."
        WHERE inproMdel = 0 AND inproStat = 0 
        --AND marc.maconNomb LIKE '%%'
        --AND (inpro.inproCpro LIKE '%%' OR inpro.inproNomb LIKE '%%') 
        --AND stocks.Total 
        --AND (inpro.inproCpro LIKE '%PTLXXX003%' OR inpro.inproNomb LIKE '%PTLXXX003%')
        GROUP BY marc.maconNomb, 
            inpro.inproCpro, 
            inpro.inproNomb, 
            umpro.inumeAbre, 
            ".implode(",",$temp2)."
        ORDER BY inpro.inproCpro
        ";
        //return dd($query);
        $test = DB::connection('sqlsrv')->select(DB::raw($query));
        $titulos[] = ['name'=>'Historial', 'data'=>'Historial', 'title'=>'Historial', 'defaultContent'=>'<button>Click!</button>'];
        $titulos[] = ['name'=>'Pedido', 'data'=>'Pedido', 'title'=>'Pedido', 'defaultContent'=>'<button>Click!</button>'];
        $titulos_excel[] = 'Total';
        if($request->gen =="export")
        {
            //return dd($pvp);
            $export = new StockExport($test, $titulos_excel);    
            return Excel::download($export, 'Reporte de Stock Actual.xlsx');
        }
        else
        {
            //return dd($titulos);
            return view('reports.vista.stockventa', compact('test', 'titulos'));
        }
        //return Excel::download(new ComprasMovExport, 'users.xlsx');
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

    public function store_almxu(Request $request)
    {
        if($request->show == true)
        {
            $almsxu = TempStockParam::where('user_id',$request->user)->get();
            return response()->json($almsxu);
        }
        else
        {
            //return response()->json($request->state);
            if($request->state == "true")
            {
                $data = TempStockParam::create([
                    'user_id'=>$request->user,
                    'alm_id'=> $request->alm,
                ]);
                return response()->json($data);
            }
            else
            {
                $test = TempStockParam::where('user_id',$request->user)->where('alm_id', $request->alm)->delete();
                return response()->json($test);
            }
        }
    }
}
