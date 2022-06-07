<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ResumenVentasTotal;

class ResumenVentasTotalController extends Controller
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
        return view('reports.resumenventastotal');
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
        $fini = date("d/m/Y", strtotime($request->fini));
        $ffin = date("d/m/Y", strtotime($request->ffin));
        $vari = "DECLARE @fini DATE, @ffin DATE
        SELECT @fini = '".$fini."', @ffin = '".$ffin."'";
        $query=
        "SELECT 
        loc as 'Local', 
        tip as 'Tipo', 
        CONVERT(VARCHAR, cast(SUM(tot) as money),1) as 'Total',  
        mon as 'Moneda', 
        CONVERT(VARCHAR, cast(SUM(efe) as money),1) as 'Efectivo', 
        CONVERT(VARCHAR, cast(SUM(ban) as money),1) as 'Banco', 
        CONVERT(VARCHAR, cast(SUM(cxc) as money),1) as 'CXC', 
        CONVERT(VARCHAR, cast(SUM(tar) as money),1) as 'Tarjeta', 
        CONVERT(VARCHAR, cast(SUM(mot) as money),1) as 'MotCont',
        CONVERT(VARCHAR, cast(SUM(otr) as money),1) as 'Otros'
        FROM
        (
            SELECT 
            cptraFtra as 'Fec', 
            adusrNomb as 'Usr',
            inlocNomb as 'Loc',
            CASE         
            WHEN adusrCusr IN (22,23,24,49) THEN 'RETAIL BALLIVIAN'
            WHEN adusrCusr IN (41) THEN 'LIBROS BALLIVIAN'
            WHEN adusrCusr IN (25,26,27,50) THEN 'RETAIL HANDAL'
            WHEN adusrCusr IN (42) THEN 'LIBROS HANDAL' 
            WHEN adusrCusr IN (32,33,34,52) THEN 'RETAIL CALACOTO'
            WHEN adusrCusr IN (43) THEN 'LIBROS CALACOTO'      
            WHEN adusrCusr IN (35,36,38,51,67) THEN 'RETAIL MARISCAL'
            WHEN adusrCusr IN (44) THEN 'LIBROS MARISCAL'   
            --WHEN adusrCusr IN (46,29,39,40,16,39,18,19,20,21,55,28,17,37,57,58,62,63) THEN adusrNomb  
            ELSE adusrNomb             
            END as Tip,
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
            AND adusrCusr NOT IN (9,65)--NO VENDEN
        ) as venta
        WHERE (fec BETWEEN @fini AND @ffin)
        GROUP BY loc, tip, mon
        ORDER BY loc, tip, mon";
        $resum = DB::connection('sqlsrv')->select(DB::raw($vari . $query));  
        /////////////////////////////administrativos
        $admin="SELECT 
        loc as 'Local', 
        tip as 'Tipo', 
        CONVERT(VARCHAR, cast(SUM(tot) as money),1) as 'Total',  
        mon as 'Moneda', 
        CONVERT(VARCHAR, cast(SUM(efe) as money),1) as 'Efectivo', 
        CONVERT(VARCHAR, cast(SUM(ban) as money),1) as 'Banco', 
        CONVERT(VARCHAR, cast(SUM(cxc) as money),1) as 'CXC', 
        CONVERT(VARCHAR, cast(SUM(tar) as money),1) as 'Tarjeta', 
        CONVERT(VARCHAR, cast(SUM(mot) as money),1) as 'MotCont',
        CONVERT(VARCHAR, cast(SUM(otr) as money),1) as 'Otros'
        FROM
        (
            SELECT 
            cptraFtra as 'Fec', 
            adusrNomb as 'Usr',
            inlocNomb as 'Loc',
            CASE         
            WHEN adusrCusr IN (22,23,24,49) THEN 'RETAIL BALLIVIAN'
            WHEN adusrCusr IN (41) THEN 'LIBROS BALLIVIAN'
            WHEN adusrCusr IN (25,26,27,50) THEN 'RETAIL HANDAL'
            WHEN adusrCusr IN (42) THEN 'LIBROS HANDAL' 
            WHEN adusrCusr IN (32,33,34,52) THEN 'RETAIL CALACOTO'
            WHEN adusrCusr IN (43) THEN 'LIBROS CALACOTO'      
            WHEN adusrCusr IN (35,36,38,51,67) THEN 'RETAIL MARISCAL'
            WHEN adusrCusr IN (44) THEN 'LIBROS MARISCAL'   
            --WHEN adusrCusr IN (46,29,39,40,16,39,18,19,20,21,55,28,17,37,57,58,62,63) THEN adusrNomb  
            ELSE adusrNomb             
            END as Tip,
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
          --  (cptraMdel = 0 AND cptraTtra = 21)
             
            adusrCusr = 65
		--	or  adusrCusr = 4
		or  adusrCusr = 9
         --   or  adusrCusr = 3
		
        ) as venta
        WHERE (fec BETWEEN @fini AND @ffin)
        GROUP BY loc, tip, mon
        ORDER BY loc, tip, mon";
        
        $adminQ = DB::connection('sqlsrv')->select(DB::raw($vari . $admin));  
        ////////////////////////////////////////////

        //------------total administrativos-------------------------//
        $totalQ=
        "SELECT 
        loc as 'Local', 
        CONVERT(VARCHAR, cast(SUM(tot) as money),1) as 'Total', 
        mon as 'Moneda', 
        CONVERT(VARCHAR, cast(SUM(efe) as money),1) as 'Efectivo', 
        CONVERT(VARCHAR, cast(SUM(ban) as money),1) as 'Banco', 
        CONVERT(VARCHAR, cast(SUM(cxc) as money),1) as 'CXC', 
        CONVERT(VARCHAR, cast(SUM(tar) as money),1) as 'Tarjeta', 
        CONVERT(VARCHAR, cast(SUM(mot) as money),1) as 'MotCont',
        CONVERT(VARCHAR, cast(SUM(otr) as money),1) as 'Otros'
        FROM
        (
            SELECT 
            cptraFtra as 'Fec', 
            adusrNomb as 'Usr',
            inlocNomb as 'Loc',
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
           (adusrCusr=65 or adusrCusr=9)
           -- cptraMdel = 0 AND cptraTtra = 21
           AND adusrCusr NOT IN (22,23,24,49,41,25,26,27,50,42,32,33,34,52,43,35,36,38,51,67,44)--NO VENDEN
        ) as venta
        WHERE (fec BETWEEN @fini AND @ffin)
        GROUP BY loc, mon
        ORDER BY loc, mon";
        $totalQ = DB::connection('sqlsrv')->select(DB::raw($vari . $totalQ));
       
        ////////////////////////////////////

        $total=
        "SELECT 
        loc as 'Local', 
        CONVERT(VARCHAR, cast(SUM(tot) as money),1) as 'Total', 
        mon as 'Moneda', 
        CONVERT(VARCHAR, cast(SUM(efe) as money),1) as 'Efectivo', 
        CONVERT(VARCHAR, cast(SUM(ban) as money),1) as 'Banco', 
        CONVERT(VARCHAR, cast(SUM(cxc) as money),1) as 'CXC', 
        CONVERT(VARCHAR, cast(SUM(tar) as money),1) as 'Tarjeta', 
        CONVERT(VARCHAR, cast(SUM(mot) as money),1) as 'MotCont',
        CONVERT(VARCHAR, cast(SUM(otr) as money),1) as 'Otros'
        FROM
        (
            SELECT 
            cptraFtra as 'Fec', 
            adusrNomb as 'Usr',
            inlocNomb as 'Loc',
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
           AND adusrCusr NOT IN (9,65)--NO VENDEN
        ) as venta
        WHERE (fec BETWEEN @fini AND @ffin)
        GROUP BY loc, mon
        ORDER BY loc, mon";
        $total = DB::connection('sqlsrv')->select(DB::raw($vari . $total));
        $totalgen=
        "SELECT 
        CONVERT(VARCHAR, cast(SUM(tot) as money),1) as 'Total',   
        mon as 'Moneda', 
        REPLACE(cast(SUM(efe) as decimal(10,2)),',', '.') as 'Efectivo', 
        REPLACE(cast(SUM(ban) as decimal(10,2)),',', '.') as 'Banco', 
        REPLACE(cast(SUM(cxc) as decimal(10,2)),',', '.') as 'CXC', 
        REPLACE(cast(SUM(tar) as decimal(10,2)),',', '.') as 'Tarjeta', 
        REPLACE(cast(SUM(mot) as decimal(10,2)),',', '.') as 'MotCont',
        REPLACE(cast(SUM(otr) as decimal(10,2)),',', '.') as 'Otros'
        FROM
        (
            SELECT 
            cptraFtra as 'Fec', 
            adusrNomb as 'Usr',
            inlocNomb as 'Loc',
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
            AND adusrCusr NOT IN (2, 3, 4,5,6,7,8,9,10,11,12,13,14,15,47,54,56)--NO VENDEN
        ) as venta
        WHERE (fec BETWEEN @fini AND @ffin)
        GROUP BY mon
        ORDER BY mon";
        $totalgen = DB::connection('sqlsrv')->select(DB::raw($vari . $totalgen));
        $resumen= [];  
        $resumenAdmin=[];
        foreach ($resum as $key => $value) {
            if (!array_key_exists($value->Local, $resumen)) 
            {
                $resumen[$value->Local] = [$resum[$key]];
            }
            else
            {
                array_push($resumen[$value->Local], $resum[$key]);
            }
        }
        foreach ($adminQ as $key => $value) {
            if (!array_key_exists($value->Local, $resumenAdmin)) 
            {
                $resumenAdmin[$value->Local] = [$adminQ[$key]];
            }
            else
            {
                array_push($resumenAdmin[$value->Local], $adminQ[$key]);
            }
        }
        foreach ($total as $key => $value) {
            if (!array_key_exists($value->Local, $total)) 
            {
                $total[$value->Local] = [$total[$key]];
                unset($total[$key]);
            }
            else
            {
                array_push($total[$value->Local], $total[$key]);
                unset($total[$key]);
            }
        }
        foreach ($totalQ as $key => $value) {
            if (!array_key_exists($value->Local, $totalQ)) 
            {
                $totalQ[$value->Local] = [$totalQ[$key]];
                unset($totalQ[$key]);
            }
            else
            {
                array_push($totalQ[$value->Local], $totalQ[$key]);
                unset($totalQ[$key]);
            }
        }
        if($request->gen =="export")
        {
            $pdf = \PDF::loadView('reports.pdf.resumenventastotal', compact('resumen', 'ffin', 'fini', 'total', 'totalgen'))
            //->setOrientation('landscape')
            ->setPaper('letter')
            ->setOption('footer-right','Pag [page] de [toPage]')
            ->setOption('footer-font-size',8);
            return $pdf->inline('Resumen_de_Ventas_Del_'.$fini.'Al_'.$ffin.'.pdf');
        }
        elseif($request->gen =="excel")
        {
            $export = new ResumenVentasTotal($resum, $ffin, $ffin);    
            return Excel::download($export, 'Resumen de Ventas.xlsx');
        }
        else if($request->gen =="ver")
        {
            return view('reports.vista.resumenventastotal', compact('resumen', 'ffin', 'fini', 'total', 'totalgen','resumenAdmin','totalQ'));
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
