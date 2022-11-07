<?php

namespace App\Http\Controllers;

use App\generadorCarta;
use App\Perfil;
use DB;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GeneradorCartaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if(Auth::user())
        {
            $user = Auth::user();
      
        
            return view('carta.index',compact('user'));      
        }
        else
        {
            return dd('largo de aqui...');
        }
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
    public function vista(Perfil $perfil, Request $request)
    {
   
       $carta = DB::table('generador_cartas')->get();
       $obs='';
       $estado='';
       $accion='';
       $int =0;
       $arrayCarta=[];
       $arrayCarta2=array();
             
      // $titulos=
      // [
        //   ['name'=>'categoria', 'data'=>'categoria', 'title'=>'Categoria', 'tip'=>'filtro'],
       foreach ($carta as $key => $value) {
        if ($value->userAuth==Auth::user()->id ) {
            $arrayCarta[] = ["obs"=>"$value->Descripcion", "estado1"=>"$value->estado1"];       
        }
     
       }

    
           
 


   
     
        return view('carta.show', compact('perfil','carta','arrayCarta'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fecha = date("d/m/Y", strtotime($request->ffin));
        $fechaCarta   = date("d/m/Y", strtotime($request->ffinf));
        $array=['enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre'];
      
       // fecha de hoy 
        $day=date("d", strtotime($request->ffinf));
        $mes=date("m", strtotime($request->ffinf));
        $año=date("Y", strtotime($request->ffinf));
        for ($i=0; $i <=sizeof($array) ; $i++) { 
            if ($i==($mes-1)) {
                $mes=$array[$i];
                break;
                  }       
        }
        $fechaH=$day.' de '.$mes.' de '.$año;
        //fecha---- de consulta
        $dayC=date("d", strtotime($request->ffinf));
        $mesC=date("m", strtotime($request->ffinf));
        $añoC=date("Y", strtotime($request->ffinf));
        for ($i=0; $i <=sizeof($array) ; $i++) { 
            if ($i==($mesC-1)) {
                $mesC=$array[$i];
                break;
                  }       
        }
        $fechaC=$dayC.' de '.$mesC.' de '.$añoC;


     //  return dd($fechaHoy);

        if($request->genPDF =="export")
        {
          $pdf = \PDF::loadView('reports.pdf.carta',compact('fechaC','fechaH'))
          ->setPaper('letter')
          ->setOption('margin-top',35)
          ->setOption('margin-left', 15)
          ->setOption('margin-right', 15)
          ->setOption('margin-bottom', 35)
          ->setOption('footer-right','Pag [page] de [toPage]')
          ->setOption('footer-font-size',8);
      
    
          return $pdf->inline('cxc_pdf', compact('fecha','fechaCarta'));
      
          //  return $pdf->inline('Reportecotizacion_'.$fecha2.'.pdf');
        }  
        return dd("no");
     $queryNameCxc =" 

     SELECT
     DISTINCT

    --   cxcTrNtra as 'Cod',
       cxcTrNcto as 'Cliente'
   
      
       FROM cxcTr 
       JOIN bd_admOlimpia.dbo.admon ON admonCmon = cxcTrMtra AND admonMdel = 0
       JOIN bd_admOlimpia.dbo.adusr ON adusrCusr = cxcTrCcbr AND adusrMdel = 0
       JOIN inloc ON inlocCloc = cxcTrCloc AND inlocMdel = 0
       JOIN cutcu ON cutcuCtcu = cxcTrCtcu AND cutcuMdel = 0      
   
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
       WHERE (cxcTrImpt - cxcTrAcmt) <> 0 AND cxcTrMdel = 0
       AND cxcTrCcbr IN (29,6,57,28,76,42,40,62,39,55,18,20,16,17,46,37,48,21,9,4,65,74,63,64,2,3,19,47,58)
       AND DATEDIFF(DAY, cxcTrFtra, getdate()) <= (30 + 15) AND DATEDIFF(DAY, cxcTrFtra, getdate()) > (30)   
       --GROUP BY estado
       
   
     ";

     $nameCxc=DB::connection('sqlsrv')->select(DB::raw($queryNameCxc));
    
     foreach ($nameCxc as $key => $value) {
      //  return dd($value->Cliente);
     }
     //$proto="BEBIDAS BOLIVIANAS BBO S.A";
     if (empty($nameCxc)) {
        return dd("DATOS NULOS REPORTE AL ADMINISTRADOR");
     }
     else {
        $query="
     
SELECT

--   cxcTrNtra as 'Cod',
   cxcTrNcto as 'Cliente',
--   isnull(imLvtRsoc,'-') as Rsocial,
--   isnull(imLvtNNit,'-') as Nit,
 imlvt.imLvtNrfc as 'NroFac',
   CONVERT(varchar,cxcTrFtra,103) as 'Fecha',
   CONVERT(varchar,DATEADD(day, 30/*DiasPlazo*/, cxcTrFtra), 103) as 'FechaVenc',
   --CONVERT(varchar,cxcTrFppg,103) as 'FPrimP',
    --DiasPlazo,
   CASE 
   WHEN DATEDIFF(DAY, cxcTrFtra, getdate()) <= 30/*DiasPlazo*/ THEN 'VIGENTE'
   WHEN DATEDIFF(DAY, cxcTrFtra, getdate()) <= (30/*DiasPlazo*/ + 15) THEN 'VENCIDO'
   WHEN DATEDIFF(DAY, cxcTrFtra, getdate()) > (30/*DiasPlazo*/ + 15) THEN 'MORA'
   END as estado,
   cast(cxcTrImpt as decimal(10,2))as 'ImporteCXC',
   sum( cast(cxcTrImpt as decimal(10,2))) as 'sumaImpBs',
   REPLACE(cast(ISNULL(cobros.AcuentaF,0) as decimal(10,2)),',', '.') as 'ACuenta',
   REPLACE(cast((ISNULL(cxcTrImpt,0)-ISNULL(cobros.AcuentaF,0)) as decimal(10,2)),',', '.') as 'Saldo',
   -----dolares----
   --sum (cast(cxcTrImpt as decimal(10,2)))as 'ImporteCXCTotal'

   cast(cxcTrImpt *6.96 as decimal(10,2) )as 'ImporteCXCDolar',
   REPLACE(cast(ISNULL(cobros.AcuentaF  * 6.96,0) as decimal(10,2)),',', '.') as 'ACuentaDolar',
   REPLACE(cast(((ISNULL(cxcTrImpt,0)-ISNULL(cobros.AcuentaF,0))*6.96) as decimal(10,2)),',', '.') as 'SaldoDolar'



   --isnull(CONVERT(varchar,cobros.FechaCuenta),'-') AS FechaCobro,
   --REPLACE(cast(cxcTrAcmt as decimal(10,2)),',', '.') as 'ACuenta',
--   cxcTrGlos as 'Glosa',
--   adusrNomb as 'Usuario',
--   admonAbrv as 'Moneda',
   --cutcuDesc as 'TipodeCuenta',
   --cxcTrNtrI as 'TransIni',
--   cxcTrNtrI as 'NroVenta',
  
--   inlocNomb as 'Local'
  
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
   WHERE (cxcTrImpt - cxcTrAcmt) <> 0 AND cxcTrMdel = 0
   AND cxcTrCcbr IN (29,6,57,28,76,42,40,62,39,55,18,20,16,17,46,37,48,21,9,4,65,74,63,64,2,3,19,47,58)
   AND DATEDIFF(DAY, cxcTrFtra, getdate()) <= (30 + 15) AND DATEDIFF(DAY, cxcTrFtra, getdate()) > (30)   
and cxcTrNcto ='HUAWEI TECHNOLOGIES SRL.'
   GROUP BY cxcTrNcto , cxcTr.cxcTrNcto, imlvt.imLvtNrfc,cxcTr.cxcTrFtra,cxcTr.cxcTrImpt,cobros.AcuentaF
                 
               ";
        
               $cxcCarta=DB::connection('sqlsrv')->select(DB::raw($query));

               //totales----------------------
              $total="
              
SELECT


   sum( cast(cxcTrImpt as decimal(10,2))) as 'sumaImpBs',

REPLACE(sum(cast(ISNULL(cobros.AcuentaF,0) as decimal(10,2))),',', '.') as 'ACuentaBs',
 REPLACE(sum(cast((ISNULL(cxcTrImpt,0)-ISNULL(cobros.AcuentaF,0)) as decimal(10,2))),',', '.')as 'SaldoBs',
   -----dolaes----
   (sum( cast(cxcTrImpt as decimal(10,2))) *6.96)as 'sumaImpDolar',
    REPLACE(sum(cast(ISNULL(cobros.AcuentaF*6.96,0) as decimal(10,2))),',', '.') as 'ACuentaDolar',
      REPLACE(sum(cast(((ISNULL(cxcTrImpt,0)-ISNULL(cobros.AcuentaF,0))*6.96) as decimal(10,2))),',', '.')as 'SaldoDolar'



  
   FROM cxcTr 
   JOIN bd_admOlimpia.dbo.admon ON admonCmon = cxcTrMtra AND admonMdel = 0
   JOIN bd_admOlimpia.dbo.adusr ON adusrCusr = cxcTrCcbr AND adusrMdel = 0
   JOIN inloc ON inlocCloc = cxcTrCloc AND inlocMdel = 0
   JOIN cutcu ON cutcuCtcu = cxcTrCtcu AND cutcuMdel = 0      

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
  
   
   LEFT JOIN
   (
       SELECT liqdCNtcc, SUM(liqdCAcmt) as AcuentaF
       FROM liqdC
       JOIN liqXC ON liqdCNtra = liqXCNtra
       WHERE liqXCMdel = 0 
       
       GROUP BY liqdCNtcc 
   )as cobros
   ON cobros.liqdCNtcc = cxcTrNtra
   WHERE (cxcTrImpt - cxcTrAcmt) <> 0 AND cxcTrMdel = 0
   AND cxcTrCcbr IN (29,6,57,28,76,42,40,62,39,55,18,20,16,17,46,37,48,21,9,4,65,74,63,64,2,3,19,47,58)
   AND DATEDIFF(DAY, cxcTrFtra, getdate()) <= (30 + 15) AND DATEDIFF(DAY, cxcTrFtra, getdate()) > (30)   
   and cxcTrNcto ='HUAWEI TECHNOLOGIES SRL.'
   

              "; 

              $totalS=DB::connection('sqlsrv')->select(DB::raw($total));          

             
        
              // return view('carta.show');

     }


   
    }


    public function perfil(Request $request)
    {

        $data=request(); 
          
        $id_user=$data['USER'];
        return view('carta.perfil');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\generadorCarta  $generadorCarta
     * @return \Illuminate\Http\Response
     */
    public function show(generadorCarta $generadorCarta)
    {
       
return $generadorCarta;
       
    }
public function pdf(){

               return view('reports.pdf.carta');

     }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\generadorCarta  $generadorCarta
     * @return \Illuminate\Http\Response
     */
    public function edit(generadorCarta $generadorCarta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\generadorCarta  $generadorCarta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, generadorCarta $generadorCarta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\generadorCarta  $generadorCarta
     * @return \Illuminate\Http\Response
     */
    public function destroy(generadorCarta $generadorCarta)
    {
        //
    }
}
