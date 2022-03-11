<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\SegmentoVenta;
use DB;
use Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CuentasPorCobrarExport;
use DataTables; 
use App\VentaSegmento;

class VentaMarcaUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sucur = $request->sucur;
        $config = $this->getConf($sucur);
        $user = $config['users'];
        $capas = $config['capas'];
        return view('reports.ventamarcaseg', compact('user', 'capas', 'sucur'));  
    }
    public function getConf($sucur){
        if($sucur == 'sucur')
        {
            $segmento = [
                ['name'=>'BALLIVIAN', 'abrv'=>'BALLIVIAN', 'users'=>[22,41,49,46]],
                ['name'=>'HANDAL', 'abrv'=>'HANDAL', 'users'=>[26,42,50,28]],
                ['name'=>'MARISCAL', 'abrv'=>'MARISCAL', 'users'=>[38,44,51,37]],
                ['name'=>'CALACOTO', 'abrv'=>'CALACOTO', 'users'=>[32,43,52,29,57]],
                ['name'=>'CASA MATRIZ', 'abrv'=>'CASA MATRIZ', 'users'=>[16,17,18,19,55,21,20,58,3,4,9, 61, 62]],
                ['name'=>'SANTA CRUZ', 'abrv'=>'SANTA CRUZ', 'users'=>[40, 39]],
                ['name'=>'COCHABAMBA', 'abrv'=>'COCHABAMBA', 'users'=>[64]],
            ];
        }
        else{
            $segmento = [
                ['name'=>'RETAIL', 'abrv'=>'RETAIL', 'users'=>[42,50,26,52,32,43,51,44,38,49,22,41]],
                ['name'=>'INSTITUCIONAL', 'abrv'=>'INST', 'users'=>[16,17,28,29,57,37,46]],
                ['name'=>'MAYORISTAS', 'abrv'=>'MAYO', 'users'=>[18,19,55,21,20,39,40,58]],
                ['name'=>'ADMINISTRATIVO', 'abrv'=>'RETAIL', 'users'=>[3,4,9]],
                ['name'=>'FERIA', 'abrv'=>'FERIA', 'users'=>[61]],
                ['name'=>'CONTRATO', 'abrv'=>'CONTRATO', 'users'=>[62]],
                ['name'=>'COCHABAMBA', 'abrv'=>'COCHABAMBA', 'users'=>[64]],
            ];
        }  
        $grupo = [
            ['name'=>'RETAIL BALLIVIAN', 'abrv'=>'RETAIL BALL', 'users'=>[49,22,41]],
            ['name'=>'RETAIL CALACOTO', 'abrv'=>'RETAIL CAL', 'users'=>[52,32,43]],
            ['name'=>'RETAIL HANDAL', 'abrv'=>'RETAIL HAN', 'users'=>[25,27,42,50,26]],
            ['name'=>'RETAIL MARISCAL', 'abrv'=>'RETAIL MCAL', 'users'=>[51,44,38]],
        ];
        $usuario = [
            ['name'=>'INS. CALACOTO', 'abrv'=>'INS. CALACOTO', 'users'=>[57,29]],
            ['name'=>'COCHABAMBA', 'abrv'=>'COCHABAMBA', 'users'=>[64], 'cochabamba'=>[61]]
        ];
        $user = $this->getUsers($segmento, $grupo, $usuario);
        $capas = 
        [
            "Segmento"=>["sig"=>"Grupo"], 
            "Grupo"=>["ant"=>"Segmento", "sig"=>"Usuario"], 
            "Usuario"=>["ant"=>"Grupo"]
        ];
        return (['users'=>$user,'capas' => $capas]);
    }

    public function getConfig(Request $request){
        if($sucur == 'sucur')
        {
            $segmento = [
                ['name'=>'BALLIVIAN', 'abrv'=>'BALLIVIAN', 'users'=>[22,41,49,46]],
                ['name'=>'HANDAL', 'abrv'=>'HANDAL', 'users'=>[26,42,50,28]],
                ['name'=>'MARISCAL', 'abrv'=>'MARISCAL', 'users'=>[38,44,51,37]],
                ['name'=>'CALACOTO', 'abrv'=>'CALACOTO', 'users'=>[32,43,52,29,57]],
                ['name'=>'CASA MATRIZ', 'abrv'=>'CASA MATRIZ', 'users'=>[16,17,18,19,55,21,20,58,3,4,9, 61, 62]],
                ['name'=>'SANTA CRUZ', 'abrv'=>'SANTA CRUZ', 'users'=>[40, 39]],
                ['name'=>'COCHABAMBA', 'abrv'=>'COCHABAMBA', 'users'=>[64]], 'alm'=>[61],
            ];
        }
        else{
            $segmento = [
                ['name'=>'RETAIL', 'abrv'=>'RETAIL', 'users'=>[42,50,26,52,32,43,51,44,38,49,22,41]],
                ['name'=>'INSTITUCIONAL', 'abrv'=>'INST', 'users'=>[16,17,28,29,57,37,46]],
                ['name'=>'MAYORISTAS', 'abrv'=>'MAYO', 'users'=>[18,19,55,21,20,39,40,58]],
                ['name'=>'ADMINISTRATIVO', 'abrv'=>'RETAIL', 'users'=>[3,4,9]],
                ['name'=>'FERIA', 'abrv'=>'FERIA', 'users'=>[61]],
                ['name'=>'CONTRATO', 'abrv'=>'CONTRATO', 'users'=>[62]],
                ['name'=>'COCHABAMBA', 'abrv'=>'COCHABAMBA', 'users'=>[64]],
            ];
        }  
        $grupo = [
            ['name'=>'RETAIL BALLIVIAN', 'abrv'=>'RETAIL BALL', 'users'=>[49,22,41]],
            ['name'=>'RETAIL CALACOTO', 'abrv'=>'RETAIL CAL', 'users'=>[52,32,43]],
            ['name'=>'RETAIL HANDAL', 'abrv'=>'RETAIL HAN', 'users'=>[25,27,42,50,26]],
            ['name'=>'RETAIL MARISCAL', 'abrv'=>'RETAIL MCAL', 'users'=>[51,44,38]],
        ];
        $usuario = [
            ['name'=>'INS. CALACOTO', 'abrv'=>'INS. CALACOTO', 'users'=>[57,29]],
            ['name'=>'COCHABAMBA', 'abrv'=>'COCHABAMBA', 'users'=>[64], 'cochabamba'=>[61]]
        ];
        $user = $this->getUsers($segmento, $grupo, $usuario);
        $capas = 
        [
            "Segmento"=>["sig"=>"Grupo"], 
            "Grupo"=>["ant"=>"Segmento", "sig"=>"Usuario"], 
            "Usuario"=>["ant"=>"Grupo"]
        ];
        return (['users'=>$user,'capas' => $capas]);
    }

    public function getUsers($segmento, $grupo, $usuario) {
        $segm=[]; $grup = []; $usua=[];
        foreach ($segmento as $s) {
            $segm[] = "WHEN adusrCusr IN (".implode(",",$s['users']).") THEN '".$s['name']."'";
        }
        foreach ($grupo as $s) {
            $grup[] = "WHEN adusrCusr IN (".implode(",",$s['users']).") THEN '".$s['name']."'";
        }
        foreach ($usuario as $s) {
            $usua[] = "WHEN adusrCusr IN (".implode(",",$s['users']).") THEN '".$s['name']."'";
        }
        $user = 
        "WITH users AS(
            SELECT
                CASE
                    ".implode($segm)."
                    ELSE 'OTROS'
                END as Segmento,  
                CASE
                    ".implode($grup)."
                    ELSE adusrNomb
                END as Grupo,
                CASE
                    ".implode($usua)."
                    ELSE adusrNomb
                END as 'Usuario',
                adusrCusr, adusrNomb
                FROM bd_admOlimpia.dbo.adusr
                WHERE adusrMdel = 0 AND 
                (adusrCusr IN(
                    SELECT vtvtaCusr
                    FROM vtVta WHERE vtvtaMdel=0
                    GROUP BY vtvtaCusr))
        )
        SELECT * FROM users ORDER BY segmento, grupo DESC";
        //return dd($user);
        $user = DB::connection('sqlsrv')->select(DB::raw($user));
        
        return $user;
    }
    public function getDatos(Request $request){
        $datos = [];
        if($request->client){
            $qclients = "SELECT crentCent,crentNomb FROM crent WHERE crentCent ='".$request->client."'";
            $client = DB::connection('sqlsrv')->select(DB::raw($qclients));
            $datos['client'] = $client[0];
        }
        if($request->marc){
            $qclients = 
            "SELECT CAST(MaconCcon as varchar)+ '|' + CAST(MaconItem as varchar),maconNomb 
            FROM macon WHERE CAST(MaconCcon as varchar)+ '|' + CAST(MaconItem as varchar) = '".$request->marc."'"; 
            $marc = DB::connection('sqlsrv')->select(DB::raw($qclients));
            $datos['marc'] = $marc[0];
        }
        return response()->json($datos);
    }
    public function general(Request $request)
    {
        // $alm_rules = ;
        $fini = date("d/m/Y", strtotime($request->fini));  
        $ffin = date("d/m/Y", strtotime($request->ffin));  
        $usr = $request->usuarios;
        $estado = $request->estado;
        $grupos = $request->grupos;
        $users = [];
        $gru_usr = [];
        $gru_tit=[];
        $gru_sum=[];
        $paretoBy = $request->paretoBy;
        $margenBy = $request->margenBy;
        if($paretoBy == 'sumtotneto'){
            $paretoBy = 'sumtot*0.87';
        }
        if($margenBy == 'sumtotneto'){
            $margenBy = 'sumtot*0.87';
        }
        foreach ($usr as $v) {

            if(!array_key_exists($v['Grupo'], $users))
            {
                $users[$v['Grupo']] = ['user'=>$v['user_id']];   
            } 
            else
            {
                $users[$v['Grupo']][] = $v['user_id'];
            }
        }
        
        foreach($users as $k => $us)
        {
            $gru_usr[] = "WHEN vtvtaCusr IN (".implode(",",$us).") THEN '".$k."'"; 
            // $gru_usr[] = "WHEN vtvtaCusr IN (".implode(",",$us).") AND vtvtaCalm IN (".implode(",", $).") THEN '".$k."'"; 
            $gru_tit[] = 
            "
            CONVERT(VARCHAR, cast(ISNULL([".$k."],0) as money),1) as [".$k."],
            CONVERT(VARCHAR, cast(ISNULL([".$k."_can],0) as numeric),1) as [".$k."_can],
            CONVERT(VARCHAR, cast(ISNULL([".$k."_cost],0) as money),1) as [".$k."_cost],";
            $gru_sum[] = " ISNULL([".$k."],0)";
            $gru_c_sum[] = " ISNULL([".$k."_can],0)";
            $gru_co_sum[] = " ISNULL([".$k."_cost],0)";
            $gru_tgrup[] = "[".$k."], [".$k."_can],[".$k."_cost],";
        }

        $vari = "DECLARE @fini DATE, @ffin DATE
        SELECT @fini = '".$fini."', @ffin = '".$ffin."';";
        $join_client = ""; $join_cost = "";
        //PRODUCTOS
        $des_gru = ""; 
        if($request->xmp=='xProducto')
        {
            $xmp = "vtvtdCpro,inproNomb,";
            $xmp_order = "vtvtdCpro,inproNomb,";
            $xmp_t = "vtvtdCpro as idmarca,
            vtvtdCpro as marca, 
            inproNomb as descr,";  
            $des_gru = "descr,";
            $marguti = "";
        }
        else if($request->xmp=='xCliente')
        {
            $xmp = "vtvtaCent,crentNomb,";
            $xmp_order = "crentNomb,";
            $xmp_t = "vtvtaCent as idmarca,
            crentNomb as marca,";
            $convert_costf = "";
            $join_client = "LEFT JOIN crEnt ON crentCent = vtvtaCent";
            $margutil = "";
        }
        else if($request->xmp=='xMarca')
        {
            $xmp = "inproMarc, MaconNomb,";
            $xmp_order = "MaconNomb, inproMarc,";
            $xmp_t = "inproMarc as idmarca,
            ISNULL(MaconNomb, 'SERVICIOS') as marca,";
            $marguti = "";
        }

        if($request->marc)
        {
            $marc = "AND inproMarc ='".$request->marc."'";
        }
        else
        {
            $marc = "";
        }
        if($request->client){
            $client = " AND vtvtaCent ='".$request->client."'";
            $join_client = "LEFT JOIN crEnt ON crentCent = vtvtaCent";
        }
        else{
            $client = "";
        }
        //$xmp = "inproCpro,";
        //$xmp_t = "inproCpro as idmarca,
        //inproCpro as marca, ";
        $marcxusr =
        "WITH vent AS
        (
            SELECT 
            ".$xmp_t ."
            ".implode($gru_tit)."
            ".implode("+",$gru_sum)." as sumtot,
            CAST(".implode("+",$gru_c_sum)." as numeric) as sumtot_can,
            ".implode("+",$gru_co_sum)." as sumtot_cost
            FROM(
                SELECT 
                ".$xmp."
                mon,tot_can,val
                FROM(
                    SELECT
                    CASE
                        ".implode($gru_usr)."
                        ELSE 'OTROS'
                    END as Grupo, 
                    ".$xmp."
                    vtvtaMtra as mon,
                    SUM(vtvtdImpT - vtvtdDesT) as total
                    ,SUM(vtvtdCant) as cant
                    ,SUM(costo) as costo
                    FROM vtVtd 
                    LEFT JOIN inpro ON inproCpro = vtvtdCpro 
                    LEFT JOIN macon ON inproMarc = CAST(MaconCcon as varchar)+ '|' + CAST(MaconItem as varchar)
                    JOIN vtVta ON vtvtaNtra = vtvtdNtra AND vtvtaMdel = 0
                    ".$join_client."
                    LEFT JOIN
                    (
                        SELECT intraNtrI, intraNtra, intrdCpro, 
                        CASE
                        WHEN SUM(intrdCTmi) < 0 THEN SUM(intrdCTmi)*-1
                        ELSE SUM(intrdCTmi) END as costo 
                        FROM intra 
                        JOIN intrd ON intrdNtra = intraNtra AND intrdMdel = 0
                        WHERE intraMdel = 0
                        GROUP BY intraNtra, intraNtrI, intrdCpro
                    ) as mov
                    ON intraNtrI =vtvtaNtra AND intrdCpro = vtvtdCpro
                    WHERE  vtvtdMdel = 0 ".$marc. $client." 
                    --AND vtvtaCusr IN (4) 
                    AND (vtvtaFtra BETWEEN @fini AND @ffin) 
                    GROUP BY vtvtaCusr, ".$xmp." vtvtaMtra
                    ) as gr
                CROSS APPLY (VALUES (Grupo+'', total), (Grupo+'_can', cant), (Grupo+'_cost', costo)) tot_val (tot_can, val)
                WHERE Grupo IN ('".implode("','",$grupos)."')
            ) as g
            PIVOT
            (
                SUM(val) 
                FOR tot_can IN ([".implode('],[',$grupos)."], [".implode('_can],[',$grupos)."_can], [".implode('_cost],[',$grupos)."_cost])
            ) AS p
        ), ventMP AS
        (
            SELECT *,
            (".$margenBy.")-(sumtot_cost) as mutil,
            (((".$margenBy.")-(sumtot_cost))/NULLIF(".$margenBy.",0))*100 as mutil_p
            FROM vent
        ), ventP AS
        (
            SELECT *, 
            ".$paretoBy."*100/(SELECT SUM(".$paretoBy.") as total FROM ventMP) as partic
            FROM ventMP
        ), fin AS
        (
            SELECT *,
            SUM(SUM(partic)) OVER (ORDER BY partic DESC) AS particAcum
            FROM ventP
            GROUP BY idmarca, marca,".implode($gru_tgrup)."".$des_gru." sumtot, sumtot_can, sumtot_cost, partic, mutil, mutil_p
        ), pareto AS
        (
            SELECT *, CONVERT(varchar, CAST(sumtot as money),1) as sumtotf,
            CONVERT(varchar, CAST(sumtot*0.87 as money),1) as sumtotn,
            CONVERT(varchar, CAST(sumtot_cost as money),1) as costof,
            CONVERT(varchar, CAST(sumtot_cost/sumtot_can as money),1) as costou,
            CASE 
                WHEN particAcum <=80 THEN 'A' 
                WHEN particAcum > 80 AND particAcum <=95 THEN 'B' 
                WHEN particAcum > 95 THEN 'C' 
            END as clas
            FROM fin 
        )
        ";
        $ventas = DB::connection('sqlsrv')->select(DB::raw($vari . $marcxusr.
        "SELECT *, 
        CONVERT(varchar,CAST(partic as decimal(20,2))) as part, 
        CONVERT(varchar,CAST(particAcum as decimal(20,2))) as partA,
        CONVERT(varchar, CAST(mutil as decimal(20,2)),1) as margutil,
        CONVERT(varchar, CAST(mutil_p as decimal(20,2)),1) as margutil_porc
        FROM pareto
        ORDER BY ".$paretoBy." DESC"
        )); 
        //return dd($ventas);
        if($request->pareto == 'true'){
            $pareto = DB::connection('sqlsrv')->select(DB::raw($vari . $marcxusr.
            ", paretoF AS(
                SELECT clas, CAST(COUNT(clas) as DECIMAL) as n, SUM(sumtot) as ventas
                FROM pareto
                GROUP BY clas
            )
            SELECT clas, n as ene, CAST(n*100/(SELECT SUM(n) as n FROM paretoF) as decimal(20,2)) as particN, 
            CONVERT(varchar,CAST(Ventas as money),1) as Ventas, 
            CAST(ventas*100/(SELECT SUM(ventas) as ventas FROM paretoF) as decimal(20,2)) as particVentas
            FROM paretoF"
            ));   
        }
        else{
            $pareto = null;
        } 
        return Datatables::of($ventas)->with(['pareto'=>$pareto])->make(); 
        
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
    public function testeo(Request $request){
        //return response()->json($request->all());
        $segmento = "SELECT adusrCusr as id, adusrNomb as [name], adusrNick as nick
        FROM bd_admOlimpia.dbo.adusr
        ";
        $user = DB::connection('sqlsrv')->select(DB::raw($segmento));
        return Datatables::of($user)->make();   
    }
}
