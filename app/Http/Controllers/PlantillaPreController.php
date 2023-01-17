<?php

namespace App\Http\Controllers;

use App\PlantillaPre;
use Illuminate\Http\Request;
use DB;

class PlantillaPreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('platilla.index');
        
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
        $query="
        SELECT   
marc.maconNomb as categoria,   
inpro.inproCpro as codigo,    
inpro.inproNomb as descripcion,   
umpro.inumeAbre as umprod,      
inpro.inproCodi as 'CodBarras',  
CONVERT(VARCHAR, cast(pvp.vtLidPrco as money),1) as pvp
FROM (    
SELECT * FROM inpro  
) as inpro          
LEFT JOIN inume as umpro ON umpro.inumeCume = inpro.inproCumb    
LEFT JOIN      
(       
SELECT    
convert(varchar,maconCcon)+'|'+convert(varchar,maconItem) as maconMarc,   
maconNomb        
FROM macon      
WHERE maconCcon = 113  
) as marc     
ON inpro.inproMarc = marc.maconMarc    
LEFT JOIN  
(    
SELECT
intrdCpro,    
ISNULL([39],0)+ISNULL([46],0) as [AC1],ISNULL([47],0)+ISNULL([40],0) as [AC2],ISNULL([7],0)+ISNULL([10],0) as [Ballivian],ISNULL([5],0)+ISNULL([29],0) as [Calacoto],ISNULL([4],0)+ISNULL([13],0) as [Handal],ISNULL([6],0)+ISNULL([30],0) as [Mariscal],ISNULL([67],0)+ISNULL([68],0) as [SanMiguel],ISNULL([71],0) as [AlmConsignacion],ISNULL([55],0) as [Feria],ISNULL([43],0) as [Planta],ISNULL([45],0) as [SantaCruz],   
ISNULL([39],0)+ISNULL([46],0)+ISNULL([47],0)+ISNULL([40],0)+ISNULL([7],0)+ISNULL([10],0)+ISNULL([5],0)+ISNULL([29],0)+ISNULL([4],0)+ISNULL([13],0)+ISNULL([6],0)+ISNULL([30],0)+ISNULL([67],0)+ISNULL([68],0)+ISNULL([55],0)+ISNULL([43],0)+ISNULL([45],0)+ISNULL([71],0) as 'Total'     FROM     (      SELECT       intrdCpro, intraCalm, SUM(intrdCanb) as cant      FROM intra    
JOIN intrd ON intraNtra = intrdNtra      WHERE intraMdel = 0 AND intrdMdel = 0                  AND intraFtra <= '29/12/2022'      GROUP BY intrdCpro, intraCalm     ) as sotck     pivot     (       SUM(cant)       for intraCalm IN ([39],[46],[47],[40],[7],[10],[5],[29],[4],[13],[6],[30],[67],[68],[55],[43],[45],[71])     ) as ptv    ) as stocks    ON stocks.intrdCpro = inpro.inproCpro  
--PVP        
LEFT JOIN     
(   
SELECT vtLidPrco, vtLidCpro  FROM vtLis JOIN vtLid ON vtLidClis = vtLisClis 
WHERE vtLisDesc = 'RETAIL BALLIVIAN'  
) as pvp    
ON pvp.vtLidCpro = inpro.inproCpro    
WHERE        
inproMdel = 0 AND inproStat = 0        
--AND   marc.maconNomb LIKE '%%'   
--AND (inpro.inproCpro LIKE '%%' OR inpro.inproNomb LIKE '%%') 
--AND stocks.Total                             
ORDER BY inpro.inproCpro
        ";
      $titulo="nada aun";;
        $test = DB::connection('sqlsrv')->select(DB::raw($query));
        return view('platilla.store',compact('test','titulo'));
        return ("desde store");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PlantillaPre  $plantillaPre
     * @return \Illuminate\Http\Response
     */
    public function show(PlantillaPre $plantillaPre)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PlantillaPre  $plantillaPre
     * @return \Illuminate\Http\Response
     */
    public function edit(PlantillaPre $plantillaPre)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PlantillaPre  $plantillaPre
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PlantillaPre $plantillaPre)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PlantillaPre  $plantillaPre
     * @return \Illuminate\Http\Response
     */
    public function destroy(PlantillaPre $plantillaPre)
    {
        //
    }
}
