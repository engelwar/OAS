<?php

namespace App\Http\Controllers;

use App\resumenxmes;
use Illuminate\Http\Request;
use DB;
use mysqli;
use DateTime;

class ResumenxmesController extends Controller
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
        //return "desde index";
        return view('reports.resumenxmes');
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
        $ff1=$ffin;
        $fdia=date("d", strtotime($request->fhoy));
        $fmes = date("d/m/Y", strtotime($request->fhoy));
        $totalGT1='0';
        $totalGT2='0';
        $totalGT3='0';
        $totalGT4='0';
        $totalGT5='0';
        $totalGT6='0';
        $totalGT7='0';
        $totalGT8='0';
        $totalGT9='0';
        $totalGT10='0';
        $totalGT11='0';
        $totalGT12='0';

        $totalGTAnual='0';
        
        $tarray1=[];
        $tarray2=[];
        $tarray3=[];
        $tarray4=[];
        $tarray5=[];
        $tarray6=[];
        $tarray7=[];
        $tarray8=[];
        $tarray9=[];
        $tarray10=[];
        $tarray11=[];
        $tarray12=[];

        $tarrayAnual=[];

        $resumeTT=[];

        //variables de meses
        $fx1="";
        $fx2="";
        $fx3="";
        $fx4="";
        $fx5="";
        $fx6="";
        $fx7="";
        $fx8="";
        $fx9="";
        $fx10="";
        $fx11="";
        $fx12="";
        //variables de arrays x mes
        $farray1=$farray2=$farray3=$farray4=$farray5=$farray6=$farray7=$farray8=$farray9=$farray10=$farray11=$farray12=[];
         $fxmes=$request->options;

         // variables para caso 2
       
        $mesini=$fxmes[0];
        
        $arrayAnios=array("ENERO","FEBRERO","MARZO","ABRIL","MAYO","JUNIO","JULIO","AGOSTO","SEPTIEMBRE","OCTUBRE","NOVIEMBRE","DICIEMBRE");
        $nn=1;
        while($nn<=2){
        $cc=1;    
        for ($i=0; $i <sizeof($arrayAnios) ; $i++) { 
            if ($mesini==$arrayAnios[$i]&&$nn==1) {
                $cc=$i+$cc;
                 $mesini=date("01/0"."$cc"."/2021");
                 
            break;
            }
          
        }
        $nn=$nn+1;
        }
  
        

       for ($ff=0; $ff < sizeof($fxmes); $ff++) { 
         if ($fxmes[$ff]=="ENERO"){
            $contador=1;
            while($contador<=2){
                if ($contador==1) {
                $fini = date('01/01/2021');
                $ffin = date('31/01/2021');
                }
                if ($contador==2) {
                $fini = date('01/01/2022');
                $ffin = date('31/01/2022');
                }
                $vari = "DECLARE @fini DATE, @ffin DATE
                SELECT @fini = '".$fini."', @ffin = '".$ffin."'";
              $totalGT1=
            "SELECT 
            CONVERT(VARCHAR, cast(SUM(tot) as money),1) as 'Total'
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
             
              $totalGT1 = DB::connection('sqlsrv')->select(DB::raw($vari.$totalGT1));
              if (empty($totalGT1)) {
                $tarray1[$contador]=0;
              }
              else{
                $tarray1[$contador]=$totalGT1[0]->Total;
              }

              




              
                $contador=$contador+1;
            }
            
         }
         if ($fxmes[$ff]=="FEBRERO") {
             $contador=1;
            while($contador<=2){
                if ($contador==1) {
                $fini = date('01/02/2021');
                $ffin = date('28/02/2021');
                }
                if ($contador==2) {
                $fini = date('01/02/2022');
                $ffin = date('28/02/2022');
                }
                $vari = "DECLARE @fini DATE, @ffin DATE
                SELECT @fini = '".$fini."', @ffin = '".$ffin."'";
              $totalGT2=
            "SELECT 
            CONVERT(VARCHAR, cast(SUM(tot) as money),1) as 'Total'
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
             
              $totalGT2 = DB::connection('sqlsrv')->select(DB::raw($vari.$totalGT2));
              if (empty($totalGT2)) {
                $tarray2[$contador]=0;
              }
              else{
                $tarray2[$contador]=$totalGT2[0]->Total;
              }
              
                $contador=$contador+1;
            }
         }
         if ($fxmes[$ff]=="MARZO") {
            $contador=1;
            while($contador<=2){
                if ($contador==1) {
                $fini = date('01/03/2021');
                $ffin = date('31/03/2021');
                }
                if ($contador==2) {
                $fini = date('01/03/2022');
                $ffin = date('31/03/2022');
                }
                $vari = "DECLARE @fini DATE, @ffin DATE
                SELECT @fini = '".$fini."', @ffin = '".$ffin."'";
              $totalGT3=
            "SELECT 
            CONVERT(VARCHAR, cast(SUM(tot) as money),1) as 'Total'
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
             
              $totalGT3 = DB::connection('sqlsrv')->select(DB::raw($vari.$totalGT3));
              if (empty($totalGT3)) {
                $tarray3[$contador]=0;
              }
              else{
                $tarray3[$contador]=$totalGT3[0]->Total;
              }
              
                $contador=$contador+1;
            }
        }
        if ($fxmes[$ff]=="ABRIL") {
            $contador=1;
            while($contador<=2){
                if ($contador==1) {
                $fini = date('01/04/2021');
                $ffin = date('30/04/2021');
                }
                if ($contador==2) {
                $fini = date('01/04/2022');
                $ffin = date('30/04/2022');
                }
                $vari = "DECLARE @fini DATE, @ffin DATE
                SELECT @fini = '".$fini."', @ffin = '".$ffin."'";
              $totalGT4=
            "SELECT 
            CONVERT(VARCHAR, cast(SUM(tot) as money),1) as 'Total'
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
             
              $totalGT4 = DB::connection('sqlsrv')->select(DB::raw($vari.$totalGT4));
              if (empty($totalGT4)) {
                $tarray4[$contador]=0;
              }
              else{
                $tarray4[$contador]=$totalGT4[0]->Total;
              }
              
                $contador=$contador+1;
            }
        }
        if ($fxmes[$ff]=="MAYO") {
            $contador=1;
            while($contador<=2){
                if ($contador==1) {
                $fini = date('01/05/2021');
                $ffin = date('31/05/2021');
                }
                if ($contador==2) {
                $fini = date('01/05/2022');
                $ffin = date('31/05/2022');
                }
                $vari = "DECLARE @fini DATE, @ffin DATE
                SELECT @fini = '".$fini."', @ffin = '".$ffin."'";
              $totalGT5=
            "SELECT 
            CONVERT(VARCHAR, cast(SUM(tot) as money),1) as 'Total'
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
             
              $totalGT5 = DB::connection('sqlsrv')->select(DB::raw($vari.$totalGT5));
              if (empty($totalGT5)) {
                $tarray5[$contador]=0;
              }
              else{
                $tarray5[$contador]=$totalGT5[0]->Total;
              }
              
                $contador=$contador+1;
            }
        }
        if ($fxmes[$ff]=="JUNIO") {
            $contador=1;
            while($contador<=2){
                if ($contador==1) {
                $fini = date('01/06/2021');
                $ffin = date('30/06/2021');
                }
                if ($contador==2) {
                $fini = date('01/06/2022');
                $ffin = date('30/06/2022');
                }
                $vari = "DECLARE @fini DATE, @ffin DATE
                SELECT @fini = '".$fini."', @ffin = '".$ffin."'";
              $totalGT6=
            "SELECT 
            CONVERT(VARCHAR, cast(SUM(tot) as money),1) as 'Total'
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
             
              $totalGT6 = DB::connection('sqlsrv')->select(DB::raw($vari.$totalGT6));
              if (empty($totalGT6)) {
                $tarray6[$contador]=0;
              }
              else{
                $tarray6[$contador]=$totalGT6[0]->Total;
              }
              
                $contador=$contador+1;
            }
        }
        if ($fxmes[$ff]=="JULIO") {
            $contador=1;
            while($contador<=2){
                if ($contador==1) {
                $fini = date('01/07/2021');
                $ffin = date('31/07/2021');
                
                }
                if ($contador==2) {
                $fini = date('01/07/2022');
                $ffin = date('31/07/2022');
                          
             
                }
               
                $vari = "DECLARE @fini DATE, @ffin DATE
                SELECT @fini = '".$fini."', @ffin = '".$ffin."'";
                
           
                    
                  $totalGT7=
                "SELECT 
                CONVERT(VARCHAR, cast(SUM(tot) as money),1) as 'Total'
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
                $totalGT7 = DB::connection('sqlsrv')->select(DB::raw($vari.$totalGT7));
               
                
                
             
              
              if (empty($totalGT7)) {
                $tarray7[$contador]="0";
              }
              else{
                $tarray7[$contador]=$totalGT7[0]->Total;
              }
              
                $contador=$contador+1;
            }
         
        }
        if ($fxmes[$ff]=="AGOSTO") {
            $contador=1;
            while($contador<=2){
                if ($contador==1) {
                $fini = date('01/08/2021');
                $ffin = date('31/08/2021');
                
                }
                if ($contador==2) {
                $fini = date('01/08/2022');
                $ffin = date('31/08/2022');
                          
             
                }
               
                $vari = "DECLARE @fini DATE, @ffin DATE
                SELECT @fini = '".$fini."', @ffin = '".$ffin."'";
                
           
                    
                  $totalGT8=
                "SELECT 
                CONVERT(VARCHAR, cast(SUM(tot) as money),1) as 'Total'
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
                $totalGT8 = DB::connection('sqlsrv')->select(DB::raw($vari.$totalGT8));
               
                
                
             
              
              if (empty($totalGT8)) {
                $tarray8[$contador]="0";
              }
              else{
                $tarray8[$contador]=$totalGT8[0]->Total;
              }
              
                $contador=$contador+1;
            }
         
        }
        if ($fxmes[$ff]=="SEPTIEMBRE") {
            $contador=1;
            while($contador<=2){
                if ($contador==1) {
                $fini = date('01/09/2021');
                $ffin = date('30/09/2021');
                
                }
                if ($contador==2) {
                $fini = date('01/09/2022');
                $ffin = date('30/09/2022');
                          
             
                }
               
                $vari = "DECLARE @fini DATE, @ffin DATE
                SELECT @fini = '".$fini."', @ffin = '".$ffin."'";
                
           
                    
                  $totalGT9=
                "SELECT 
                CONVERT(VARCHAR, cast(SUM(tot) as money),1) as 'Total'
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
                $totalGT9 = DB::connection('sqlsrv')->select(DB::raw($vari.$totalGT9));
               
                
                
             
              
              if (empty($totalGT9)) {
                $tarray9[$contador]="0";
              }
              else{
                $tarray9[$contador]=$totalGT9[0]->Total;
              }
              
                $contador=$contador+1;
            }
         
        }
         if ($fxmes[$ff]=="AGOSTO") {
            $contador=1;
            while($contador<=2){
                if ($contador==1) {
                $fini = date('01/08/2021');
                $ffin = date('31/08/2021');
                
                }
                if ($contador==2) {
                $fini = date('01/08/2022');
                $ffin = date('31/08/2022');
                          
             
                }
               
                $vari = "DECLARE @fini DATE, @ffin DATE
                SELECT @fini = '".$fini."', @ffin = '".$ffin."'";
                
           
                    
                  $totalGT8=
                "SELECT 
                CONVERT(VARCHAR, cast(SUM(tot) as money),1) as 'Total'
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
                $totalGT8 = DB::connection('sqlsrv')->select(DB::raw($vari.$totalGT8));
               
                
                
             
              
              if (empty($totalGT8)) {
                $tarray8[$contador]="0";
              }
              else{
                $tarray8[$contador]=$totalGT8[0]->Total;
              }
              
                $contador=$contador+1;
            }
         
        }
        if ($fxmes[$ff]=="SEPTIEMBRE") {
            $contador=1;
            while($contador<=2){
                if ($contador==1) {
                $fini = date('01/09/2021');
                $ffin = date('30/09/2021');
                
                }
                if ($contador==2) {
                $fini = date('01/09/2022');
                $ffin = date('30/09/2022');
                          
             
                }
               
                $vari = "DECLARE @fini DATE, @ffin DATE
                SELECT @fini = '".$fini."', @ffin = '".$ffin."'";
                
           
                    
                  $totalGT9=
                "SELECT 
                CONVERT(VARCHAR, cast(SUM(tot) as money),1) as 'Total'
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
                $totalGT9 = DB::connection('sqlsrv')->select(DB::raw($vari.$totalGT9));
               
                
                
             
              
              if (empty($totalGT9)) {
                $tarray9[$contador]="0";
              }
              else{
                $tarray9[$contador]=$totalGT9[0]->Total;
              }
              
                $contador=$contador+1;
            }
         
        }
        if ($fxmes[$ff]=="OCTUBRE") {
            $contador=1;
            while($contador<=2){
                if ($contador==1) {
                $fini = date('01/10/2021');
                $ffin = date('31/10/2021');
                
                }
                if ($contador==2) {
                $fini = date('01/10/2022');
                $ffin = date('31/10/2022');
                          
             
                }
               
                $vari = "DECLARE @fini DATE, @ffin DATE
                SELECT @fini = '".$fini."', @ffin = '".$ffin."'";
                
           
                    
                  $totalGT10=
                "SELECT 
                CONVERT(VARCHAR, cast(SUM(tot) as money),1) as 'Total'
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
                $totalGT10 = DB::connection('sqlsrv')->select(DB::raw($vari.$totalGT10));
               
                
                
             
              
              if (empty($totalGT10)) {
                $tarray10[$contador]="0";
              }
              else{
                $tarray10[$contador]=$totalGT10[0]->Total;
              }
              
                $contador=$contador+1;
            }
         
        }
        if ($fxmes[$ff]=="NOVIEMBRE") {
            $contador=1;
            while($contador<=2){
                if ($contador==1) {
                $fini = date('01/11/2021');
                $ffin = date('30/11/2021');
                
                }
                if ($contador==2) {
                $fini = date('01/11/2022');
                $ffin = date('30/11/2022');
                          
             
                }
               
                $vari = "DECLARE @fini DATE, @ffin DATE
                SELECT @fini = '".$fini."', @ffin = '".$ffin."'";
                
           
                    
                  $totalGT11
                  =
                "SELECT 
                CONVERT(VARCHAR, cast(SUM(tot) as money),1) as 'Total'
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
                $totalGT11 = DB::connection('sqlsrv')->select(DB::raw($vari.$totalGT11));
               
                
                
             
              
              if (empty($totalGT11)) {
                $tarray11[$contador]="0";
              }
              else{
                $tarray11[$contador]=$totalGT11[0]->Total;
              }
              
                $contador=$contador+1;
            }
         
        }
        if ($fxmes[$ff]=="DICIEMBRE") {
            $contador=1;
            while($contador<=2){
                if ($contador==1) {
                $fini = date('01/12/2021');
                $ffin = date('31/12/2021');
                
                }
                if ($contador==2) {
                $fini = date('01/12/2022');
                $ffin = date('31/12/2022');
                          
             
                }
               
                $vari = "DECLARE @fini DATE, @ffin DATE
                SELECT @fini = '".$fini."', @ffin = '".$ffin."'";
                
           
                    
                  $totalGT12=
                "SELECT 
                CONVERT(VARCHAR, cast(SUM(tot) as money),1) as 'Total'
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
                $totalGT12 = DB::connection('sqlsrv')->select(DB::raw($vari.$totalGT12));
               
                
                
             
              
              if (empty($totalGT12)) {
                $tarray12[$contador]="0";
              }
              else{
                $tarray12[$contador]=$totalGT12[0]->Total;
              }
              
                $contador=$contador+1;
            }
         
        }
       }

      
        $contador=1;
        while($contador<=2){
            if ($contador==1) {
            $fini = date('01/01/2021');
            $ffin = date('31/12/2021');
            }
            if ($contador==2) {
            $fini = date('01/01/2022');
            $ffin = date('31/12/2022');
            }
            $vari = "DECLARE @fini DATE, @ffin DATE
            SELECT @fini = '".$fini."', @ffin = '".$ffin."'";
            $totalGTAnual=
        "SELECT 
        CONVERT(VARCHAR, cast(SUM(tot) as money),1) as 'Total'
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
         
         $totalGTAnual = DB::connection('sqlsrv')->select(DB::raw($vari.$totalGTAnual));
          if (empty($totalGTAnual)) {
            $tarrayAnual[$contador]=0;
          }
          else{
            $tarrayAnual[$contador]= $totalGTAnual[0]->Total;
          }
          
            $contador=$contador+1;
        }
    ///////////////////////// resumen
    
    $vari = "DECLARE @fini DATE, @ffin DATE
    SELECT @fini = '".$mesini."', @ffin = '".$ff1."'";
    $resumen2=[];   
   
        $query=
        "SELECT 
        loc as 'Local', 
        tip as 'Tipo', 
            CONVERT(VARCHAR, cast(SUM(tot) as money),1) as 'Total'
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
        $resum2 = DB::connection('sqlsrv')->select(DB::raw($vari . $query)); 
        $resumen2=[]; 
        //datos --------------------------------- total
        $fini = date('01/03/2021');
        $ffin = date('31/03/2021');
        $vari = "DECLARE @fini DATE, @ffin DATE
    SELECT @fini = '".$fini."', @ffin = '".$ffin."'";
    
   
        $query=
        "SELECT 
        loc as 'Local', 
        tip as 'Tipo', 
            CONVERT(VARCHAR, cast(SUM(tot) as money),1) as 'Total'
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
        $resum2T = DB::connection('sqlsrv')->select(DB::raw($vari . $query));     
        $resumen2T=[]; 

        $vari = "DECLARE @fini DATE, @ffin DATE
    SELECT @fini = '".$mesini."', @ffin = '".$ff1."'";
        $total2=
            "SELECT 
            loc as 'Local', 
            CONVERT(VARCHAR, cast(SUM(tot) as money),1) as 'Total'
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
            $total2 = DB::connection('sqlsrv')->select(DB::raw($vari . $total2));
         
       
        foreach ($resum2 as $key => $value) {
            if (!array_key_exists($value->Local, $resumen2)) 
            {
                $resumen2[$value->Local] = [$resum2[$key]];
            }
            else
            {
                array_push($resumen2[$value->Local], $resum2[$key]);
            }
        }foreach ($resum2T as $key => $value) {
            if (!array_key_exists($value->Local, $resumen2T)) 
            {
                $resumen2T[$value->Local] = [$resum2T[$key]];
            }
            else
            {
                array_push($resumen2T[$value->Local], $resum2T[$key]);
            }
        }
        foreach ($total2 as $key => $value) {
            if (!array_key_exists($value->Local, $total2)) 
            {
                $total2[$value->Local] = [$total2[$key]];
                unset($total2[$key]);
            }
            else
            {
                array_push($total2[$value->Local], $total2[$key]);
                unset($total2[$key]);
            }
        }
      
 
        ///////////////////////////////////////////////////////////////
    


     
        $vari = "DECLARE @fini DATE, @ffin DATE
        SELECT @fini = '".$fini."', @ffin = '".$ffin."'";
       
        
            $query=
            "SELECT 
            loc as 'Local', 
            tip as 'Tipo', 
            CONVERT(VARCHAR, cast(SUM(tot) as money),1) as 'Total'
           
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
            CONVERT(VARCHAR, cast(SUM(tot) as money),1) as 'Total'
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
               adusrCusr=65 or adusrCusr=9
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
            CONVERT(VARCHAR, cast(SUM(tot) as money),1) as 'Total'
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

            return view('reports.vista.resumenxmesvista', compact('tarrayAnual','fdia','fmes','resumen','total2','resumen2','resumen2T','fxmes','ffin','tarray1','tarray2','tarray3','tarray4','tarray5','tarray6','tarray7','tarray8','tarray9','tarray10','tarray11','tarray12','fini', 'total', 'totalgen','resumenAdmin','totalQ'));
        
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\resumenxmes  $resumenxmes
     * @return \Illuminate\Http\Response
     */
    public function show(resumenxmes $resumenxmes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\resumenxmes  $resumenxmes
     * @return \Illuminate\Http\Response
     */
    public function edit(resumenxmes $resumenxmes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\resumenxmes  $resumenxmes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, resumenxmes $resumenxmes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\resumenxmes  $resumenxmes
     * @return \Illuminate\Http\Response
     */
    public function destroy(resumenxmes $resumenxmes)
    {
        //
    }
}
