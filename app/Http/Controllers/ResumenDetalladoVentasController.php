<?php

namespace App\Http\Controllers;

use App\ResumenDetalladoVentas;
use Illuminate\Http\Request;
use DB;

class ResumenDetalladoVentasController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        return view('reports.resumentotalventasDetallado');
        return "desde index";

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

        

        if($request->gen =="ver")
        {
            $fini = date("d/m/Y", strtotime($request->fini));
        $ffin = date("d/m/Y", strtotime($request->ffin));
        $vari = "DECLARE @fini DATE, @ffin DATE
        SELECT @fini = '".$fini."', @ffin = '".$ffin."'";
        $query="
        SELECT 
        loc as 'Local', 
        CONVERT(VARCHAR, cast(SUM(imp-dest) as money),1) as 'Total', 
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
           -- vtvtaTotT as 'tot', 
           -- vtvtdImpT	as 'imp',
			--vtvtdDesT  as 'dest',
            imp,
            dest,
            admonAbrv as 'mon', 
            cptraCajS as 'efe', 
            cptraBanS as 'ban', 
            cptraCxcS as 'cxc',
            cptraTarS as 'tar', 
            cptraMcnS as 'Mot', cptraCheS+cptraCmpS+cptraOpPd as 'Otr'
            FROM cptra
           --JOIN vtVtd ON vtvtdNtra = cptraNtrI
			JOIN (
				SELECT vtvtdNtra, SUM(vtvtdImpT) AS 'imp', SUM(vtvtdDesT) AS 'dest'
				FROM vtVtd
				where vtvtdMdel =0
				GROUP BY vtvtdNtra
			) as venta ON venta.vtvtdNtra = cptraNtrI
              JOIN bd_admOlimpia.dbo.adusr ON adusrCusr = cptraCusr
            JOIN bd_admOlimpia.dbo.admon ON admonCmon = cptraMtra
            join inloc ON inlocCloc = cptraCloc
    WHERE 
            cptraMdel = 0 AND cptraTtra = 21
           AND adusrCusr NOT IN (9,65,61,80)--NO VENDEN

		   and inlocCloc not in(1,10,9)
        ) as venta
        WHERE (fec BETWEEN @fini AND @ffin)
        GROUP BY loc, mon
        ORDER BY loc, mon


        ";
        $queryNivel1=DB::connection('sqlsrv')->select(DB::raw($vari.$query));
          
            return view('reports.vista.ressumentotalvetasdetalladoVista',compact('queryNivel1'));
        }
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ResumenDetalladoVentas  $resumenDetalladoVentas
     * @return \Illuminate\Http\Response
     */
    public function show(ResumenDetalladoVentas $resumenDetalladoVentas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ResumenDetalladoVentas  $resumenDetalladoVentas
     * @return \Illuminate\Http\Response
     */
    public function edit(ResumenDetalladoVentas $resumenDetalladoVentas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ResumenDetalladoVentas  $resumenDetalladoVentas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ResumenDetalladoVentas $resumenDetalladoVentas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ResumenDetalladoVentas  $resumenDetalladoVentas
     * @return \Illuminate\Http\Response
     */
    public function destroy(ResumenDetalladoVentas $resumenDetalladoVentas)
    {
        //
    }
}
