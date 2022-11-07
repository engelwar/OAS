<?php

namespace App\Http\Controllers;

use App\CuentasXC;
use Illuminate\Http\Request;
use DB;
use Auth;
use App\User;

class CuentasXCController extends Controller
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
       
            $msnCxC =
       "	

       SELECT
       CONVERT(varchar,GETDATE(),103) as 'today',
       cxcTrNtra as 'Cod',
       cxcTrNcto as 'Cliente',
       isnull(imLvtRsoc,'-') as Rsocial,
       isnull(imLvtNNit,'-') as Nit,
       CONVERT(varchar,cxcTrFtra,103) as 'Fecha',
       CONVERT(varchar,DATEADD(day, 30/*DiasPlazo*/, cxcTrFtra), 103) as 'FechaVenc',

       
      CONVERT(varchar,cxcTrFppg,103) as 'FPrimP',
       cast(cxcTrImpt as decimal(10,2))as 'ImporteCXC',
       REPLACE(cast(ISNULL(cobros.AcuentaF,0) as decimal(10,2)),',', '.') as 'ACuenta',
       REPLACE(cast((ISNULL(cxcTrImpt,0)-ISNULL(cobros.AcuentaF,0)) as decimal(10,2)),',', '.') as 'Saldo',
       --isnull(CONVERT(varchar,cobros.FechaCuenta),'-') AS FechaCobro,
       --REPLACE(cast(cxcTrAcmt as decimal(10,2)),',', '.') as 'ACuenta',
       cxcTrGlos as 'Glosa',
       adusrNomb as 'Usuario',
       admonAbrv as 'Moneda',
       --cutcuDesc as 'TipodeCuenta',
       --cxcTrNtrI as 'TransIni',
       cxcTrNtrI as 'NroVenta',
       imlvt.imLvtNrfc as 'NroFac',
       inlocNomb as 'Local'
       --DiasPlazo,
      
       FROM cxcTr 
       JOIN bd_admOlimpia.dbo.admon ON admonCmon = cxcTrMtra AND admonMdel = 0
       JOIN bd_admOlimpia.dbo.adusr ON adusrCusr = cxcTrCcbr AND adusrMdel = 0
       JOIN inloc ON inlocCloc = cxcTrCloc AND inlocMdel = 0
       JOIN cutcu ON cutcuCtcu = cxcTrCtcu AND cutcuMdel = 0      
       --//CXC generadas por VENTAS
       /*JOIN
       (
       SELECT *
       FROM cptra 
       JOIN cptrd ON cptrdNtra = cptraNtra AND cptrdTtra = 11
       WHERE cptraTtra = 21 AND cptraMdel = 0
       ) cptra
       ON cptrdNtrD = cxcTrNtra*/
       --//CXC generadas por VENTAS 
       LEFT JOIN
       (
           SELECT 
           imLvtNlvt, imLvtNNit,
           imLvtRsoc, imLvtNrfc,
           imlvtNvta, imLvtEsfc,
           imLvtMdel, imLvtFech
           FROM imlvt WHERE imlvtNvta <> 0
           UNION
           (
               SELECT 
                   imLvtNlvt, imLvtNNit,
                   imLvtRsoc, imLvtNrfc,
                   vtVxFNvta as imlvtNvta,
                   imLvtEsfc, imLvtMdel,
                   imLvtFech
               FROM imlvt 
               JOIN vtVxF ON imLvtNlvt = vtVxFLvta
           )
       )as imlvt 
       ON (imLvtNvta = cxcTrNtrI) AND imLvtMdel = 0
       LEFT JOIN 
       (
           SELECT 
           crentCent,
           maprfDplz as 'DiasPlazo'
           FROM crEnt
           LEFT JOIN maprf ON maprfCprf = crentClsf AND maPrfMdel = 0
           WHERE crentMdel = 0 AND crentStat = 0
       ) as crent
       ON crentCent = cxcTrCcto
       --COBROS DE CXC
       
       LEFT JOIN
       (
           SELECT liqdCNtcc, SUM(liqdCAcmt) as AcuentaF
           FROM liqdC
           JOIN liqXC ON liqdCNtra = liqXCNtra
           WHERE liqXCMdel = 0 
           
           GROUP BY liqdCNtcc
       )as cobros
       ON cobros.liqdCNtcc = cxcTrNtra
       WHERE (cxcTrImpt - cxcTrAcmt) <> 0 AND cxcTrMdel = 0 and (cxcTrFppg between getdate()-5 and getdate()) and cxcTrCtcu=1
       AND cxcTrCcbr IN (29,6,57,28,42,40,62,39,55,18,20,16,17,46,37,48,21,9,4,65,74,63,64,2,3,19,47,58)
   and  cast(cxcTrImpt as decimal(10,2)) <> REPLACE(cast((ISNULL(cxcTrImpt,0)-ISNULL(cobros.AcuentaF,0)) as decimal(10,2)),',', '.')   
   and   cast(cxcTrImpt as decimal(10,2)) <>  REPLACE(cast(ISNULL(cobros.AcuentaF,0) as decimal(10,2)),',', '.') 

 ";
     
            
      $msnX = DB::connection('sqlsrv')->select(DB::raw($msnCxC));
    
      $tamaño = sizeof($msnX);
         
            return view('inicio', compact('msnX','tamaño'));
          
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
     * @param  \App\CuentasXC  $cuentasXC
     * @return \Illuminate\Http\Response
     */
    public function show(CuentasXC $cuentasXC)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CuentasXC  $cuentasXC
     * @return \Illuminate\Http\Response
     */
    public function edit(CuentasXC $cuentasXC)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CuentasXC  $cuentasXC
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CuentasXC $cuentasXC)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CuentasXC  $cuentasXC
     * @return \Illuminate\Http\Response
     */
    public function destroy(CuentasXC $cuentasXC)
    {
        //
    }
}
