<?php

namespace App\Http\Controllers;

//use App\Cotizacion_report;

use App\Cotizacion_report; 
use Illuminate\Http\Request;
use App\User;
use DB;
use PDF;
use Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CuentasPorCobrarExport;
use App\observacion_estados;
use App\ObservacionCotizacion;
use Illuminate\Support\Facades\Redirect;
use PhpParser\Node\Expr\Cast;
use Observaciones;
//use App\Providers\Cotizacion_report;


class CotizacionReportController extends Controller
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
        if(Auth::user()->authorizePermisos(['Reporte de cotizacion', 'Ver usuarios DualBiz']))
        {
            $usuario= "";
        }
        else if (Auth::user()->authorizePermisos(['Reporte de cotizacion', 'Ver usuarios OAS']))
        {
            $users= User::where('dbiz_user','<>',NULL)->get()->pluck('dbiz_user')->toArray();
            $users= implode(",", $users);
            $usuario ="AND adusrCusr IN (".$users.")";
        }
        else{
            if(Auth::user()->dbiz_user == null)
            {
                $usuario= "AND adusrCusr = null";
            }
            else
            {
            $usuario= "AND adusrCusr = ".Auth::user()->dbiz_user;
            }
        }
        $query = 
        "SELECT * 
        FROM bd_admOlimpia.dbo.adusr 
        WHERE adusrMdel = 0 ".$usuario."
        AND (adusrCusr IN 
        (
            SELECT vtvtaCusr
            FROM vtvta
            GROUP BY vtvtaCusr
        ))
        ORDER BY adusrNomb";
        $usr = DB::connection('sqlsrv')->select(DB::raw($query));
        $user = collect($usr);
        $consultaListaEmpleados = "select adusrNomb as 'nombreX',adusrCusr as 'codigoX' from bd_admOlimpia.dbo.adusr where 
        adusrNomb ='BENIGNA TINTA'
        OR adusrNomb ='ADRIANA CHAVEZ'
        OR adusrNomb ='AUDINI CARRILLO'
        OR adusrNomb ='INS MARISCAL'
        OR adusrNomb ='INS BALLIVIAN'
        OR adusrNomb ='ADRIANA CHAVEZ'
        OR adusrNomb ='CONTRATOS INSTITUCIONALES'
        OR adusrNomb ='INES VELASQUEZ'
        OR adusrNomb ='GUADALUPE AMBA'
        order by adusrNomb asc";
        $usu = DB::connection('sqlsrv')->select(DB::raw($consultaListaEmpleados)); 
     

        return view('cotizacionReport.vistaCotizacionReport', compact('user','usu'));
        //return ("desde cotizacionreport");
        //return view('cotizacionReport.vistaCotizacionReport');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return "desde create";
    }

    //mostrar pdf
    public function crearZ(Request $request){
   
      //dd($request->all());
         $data=request(); 
         $cotT=Cotizacion_report::all('id');
         $c=0;
         $dato=$data['id_cotizacion'];
         $dato=strval($dato);
         $dato='{"id":'.$dato."}";
      
      // for ($i=0;$i<5;$i++){
     //   $c=$c+1;
     //  }
 
       foreach ($cotT as $value) {
      
            if ($value==$dato) {
              return  "datos repetidos"; 
            } 
               
        }
     
        DB::table('observacion_cotizacions')->insert([
            'id'=>$data['id_cotizacion'],
            'idObs'=>$data['id_cotizacion'],
            'user_id'=>$data['iduser'],
            'textObs'=>$data['comentario'],
            'nroMod'=>0,
            'nro'=>0,
            'nroA'=>0,
            'nroP'=>0,
            'nroT'=>0,
            'fechaC'=>date('Y-m-d H:i:s')
      ]);
     
      return "cargado con exito";
      //echo "desde crearZ";
      // return redirect()->action('CotizacionReportController@store'');
       // return redirect('CotizacionReporte/vistaTotal/v');
   
       
    }
    public function verPDF()
    {
        echo "desde pdf";
    }

    public function crearTablaObservacion(Request $request){
        // $table->string('id_cotizacion');
        //    $table->string('comentario'); 

      //  DB::table('observacion_cotizacions')->insert(
       //     ['id_cotizacion'  => '12345',
       //     'comentario'=>'es un caomentario']
       // );
      
      //  return redirect()->action('CotizacionReport');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * 
     * 
     */
    public function store(Request $request, Cotizacion_report $cotizacion_report ) 
    {   
        $estadoF=observacion_estados::all('cotizacion_form_id','estado');
        $fini = date("d/m/Y", strtotime($request->fini));
        $ffin = date("d/m/Y", strtotime($request->ffin));
        $fecha = "(vtvtaFent BETWEEN '".$fini."' AND '".$ffin."') AND ";
        
        $otroUsuario="";  
        $otroUsuario2=" OR adusrNomb = ";  
       
        $cadenaOp="adusrNomb = ";  
        $varOp=$request->options;
        $i=0;
        $varInteger=$request->options;
        $varInteger=(sizeof($varInteger))-1;
     
        for($i; $i<=$varInteger;$i++ ){
         //   dd($varOp[$i]);
            if ($varInteger>0) {
               $otroUsuario=($varOp[$i]);
               if ($i==0) {
                  $cadenaOp=$cadenaOp."'".$otroUsuario."'";
                } else {
                  $cadenaOp=$cadenaOp.$otroUsuario2."'".$otroUsuario."'";
             }
            } else {
                $otroUsuario= implode("",$varOp);
                $cadenaOp=$cadenaOp."'".$otroUsuario."'";
            }
        } 
             
        
      

        $esUnaQuery = 
        " 
        select CONVERT(varchar,vtvtaFent,103) as 'Fecha',
            --vtvtaNcot as 'NroCotizacion',
            case when vtvtaNcot >0 then convert(varchar,vtvtaNcot) else '-' end as 'NroCotizacion',
            --	case  when vtvtaNcot = 0  then CAST(REPLACE('vtvtaNcot','0','-')) else vtvtaNcot end as 'NroCotizacion',
            --case CAST(vtvtaNcot as varchar(10)) when vtvtaNcot=0 then '' else vtvtaNcot end as 'NroCotizacion',
                vtvtaNomC as 'Cliente',
                CONVERT(varchar, vtvtaFtra, 103)	 as 'FechaNR',
                vtvtaNtra as 'NR',
                REPLACE(cast (round(vtvtaTotT,2) as decimal(10,2)),',', '.') as 'Totalventas',
                admonAbrv 'Moneda',
                 adusrNomb as 'Usuario',
                 inlocNomb as 'Local',
                     CONVERT(varchar,imlvtFech,103) as 'FechaFac',--facturacion,
                    imlvtNrfc as 'numerofactura',
                   imLvtEsfc as  'estado' 
                   
        from vtVta 
        LEFT JOIN bd_admOlimpia.dbo.admon ON (admonCmon=vtvtaMtra AND admonMdel=0) 
        LEFT JOIN bd_admOlimpia.dbo.adusr ON (adusrCusr=vtvtaCusr AND adusrMdel=0)
        JOIN inloc ON (inlocCloc=vtvtaCloc AND inlocMdel=0) 
        left join imlvt on vtvtaNtra=imlvtNvta
        
            where (
                $fecha
                $cadenaOp
            )
        order by vtvtaFent desc

        ";
        
        //$observacionBD=DB::table('observacion_cotizacion')->get()->pluck('idObs','textObs','user_id','modifUno','modifiDos','nroMod','fechaC');          
        $observacionBD=Cotizacion_report::all(['id','idObs','textObs','user_id','nroMod','fechaC']);
        $cr=observacion_estados::all(['id']);
        $consutas = DB::connection('sqlsrv')->select(DB::raw($esUnaQuery));
      

       //  $nombre = 'Fernando';
        ///////////////////////
        if($request->gen =="export")
        {
            $pdf = \PDF::loadView('reports.pdf.prueba')->with('consultas',$consutas) ->with('fecha',$fecha)
            ->setOrientation('landscape')
            ->setPaper('letter')
            ->setOption('footer-right','Pag [page] de [toPage]')
            ->setOption('footer-font-size',8);
            //return $pdf->inline('Reportecotizacion'.$fecha.'.pdf');
            return $pdf->inline('Reportecotizacion'.$fecha.'.pdf');
        }
        elseif($request->gen =="excel")
        {
            $export = new CuentasPorCobrarExport($consutas, $fecha);    
            return Excel::download($export, 'Reporte Cotizacion.xlsx');
        }
        else if($request->gen =="ver")
        {
            return view('cotizacionReport.vistaFormularioTotal')
          //  ->with('nombre', $nombre)
            ->with('consultas',$consutas)
            //->with('user_id',$user_id);
            ->with('cotizacion_report', $cotizacion_report)
            ->with('fecha',$fecha)
            ->with('observacionBD',$observacionBD)
            ->with('cr',$cr)
            ->with('estadoF',$estadoF);
            ;
        }
        ////////////////////////
       
         

       // return view('cotizacionReport.vistaFormularioTotal')
       // ->with('nombre', $nombre)
       // ->with('consultas',$consutas);
            
        
    }
    public function listaUsuario(){
             
        return "no tiene edicion ";

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cotizacion_report  $cotizacion_report
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
       /** 
        if(!$request->user)
        {
            $error = "Ningun usuario fue seleccionado para generar el reporte";
            return view("errors.error_variable", compact('error'));
        }       
        else if (Auth::user()->authorizePermisos(['Notas De Remisión', 'Rango de Fechas']))
        {
            $fini = date("d/m/Y", strtotime($request->fini));
            $ffin = date("d/m/Y", strtotime($request->ffin));
            $fecha = "AND (vtvtaFent BETWEEN '".$fini."' AND '".$ffin."')";
        }
        else
        {
            $fini = date("d/m/Y",strtotime("1/1/1900"));
            $ffin = date("d/m/Y", strtotime($request->ffin));
            //return dd($ffin);
            $fecha = "AND (vtvtaFent = '".$ffin."')";
        }
        $user_id = 28;
        $facturas = "" ;
        if(!$request->facturadas)
        {
            $facturas = "AND imlvtNvta IS NULL";
        }
        $vari = "DECLARE @usuario INT
        SELECT @usuario =".$user_id;
        */
        
        $fini = date("d/m/Y", strtotime($request->fini));
        $ffin = date("d/m/Y", strtotime($request->ffin));
        $fecha = "(vtvtaFent BETWEEN '".$fini."' AND '".$ffin."') AND ";
        
        $otroUsuario="";  
        $otroUsuario2=" OR adusrNomb = ";  
       
        $cadenaOp="adusrNomb = ";  
        $varOp=$request->options;
        $i=0;
        $varInteger=$request->options;
        $varInteger=(sizeof($varInteger))-1;
     
        for($i; $i<=$varInteger;$i++ ){
         //   dd($varOp[$i]);
            if ($varInteger>0) {
               $otroUsuario=($varOp[$i]);
               if ($i==0) {
                  $cadenaOp=$cadenaOp."'".$otroUsuario."'";
                } else {
                  $cadenaOp=$cadenaOp.$otroUsuario2."'".$otroUsuario."'";
             }
            } else {
                $otroUsuario= implode("",$varOp);
                $cadenaOp=$cadenaOp."'".$otroUsuario."'";
            }
        } 
             
        
      
        $esUnaQuery = 
        " 
        select CONVERT(varchar,vtvtaFent,103) as 'Fecha',
            --vtvtaNcot as 'NroCotizacion',
            case when vtvtaNcot >0 then convert(varchar,vtvtaNcot) else '-' end as 'NroCotizacion',
            --	case  when vtvtaNcot = 0  then CAST(REPLACE('vtvtaNcot','0','-')) else vtvtaNcot end as 'NroCotizacion',
            --case CAST(vtvtaNcot as varchar(10)) when vtvtaNcot=0 then '' else vtvtaNcot end as 'NroCotizacion',
                vtvtaNomC as 'Cliente',
                CONVERT(varchar, vtvtaFtra, 103)	 as 'FechaNR',
                vtvtaNtra as 'NR',
                REPLACE(cast (round(vtvtaTotT,2) as decimal(10,2)),',', '.') as 'Totalventas',
                admonAbrv 'Moneda',
                 adusrNomb as 'Usuario',
                 inlocNomb as 'Local',
                     CONVERT(varchar,imlvtFech,103) as 'FechaFac',--facturacion,
                    imlvtNrfc as 'numerofactura',
                   imLvtEsfc as  'estado' 
                   
        from vtVta 
        LEFT JOIN bd_admOlimpia.dbo.admon ON (admonCmon=vtvtaMtra AND admonMdel=0) 
        LEFT JOIN bd_admOlimpia.dbo.adusr ON (adusrCusr=vtvtaCusr AND adusrMdel=0)
        JOIN inloc ON (inlocCloc=vtvtaCloc AND inlocMdel=0) 
        left join imlvt on vtvtaNtra=imlvtNvta
        
            where (
                $fecha
                $cadenaOp
            )
        order by vtvtaFent desc
        
        ";
       
         $consutas = DB::connection('sqlsrv')->select(DB::raw($esUnaQuery));

         $nombre = 'Fernando';
        
       
        

/** *        return view('reports.pdf.prueba')
        
                ->with('nombre', $nombre)
                ->with('consultas',$consutas)
                ->with('fecha',$fecha)
             
                ;
     */
          
                
            //    ;
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cotizacion_report  $cotizacion_report
     * @return \Illuminate\Http\Response
     */
    public function edit(Cotizacion_report $cotizacion_report)
    {
        $estaSegui = observacion_estados::where('estado','Seguimiento')->first();
        $commetx=observacion_estados::all('id','estado','textObs1','cotizacion_form_id','created_at','updated_at');
        $cotT=Cotizacion_report::all('id');
        return view('cotizacionReport.edit')
        ->with('commetx',$commetx)
        ->with('cotizacion_report',$cotizacion_report)
        ->with('cotT',$cotT)
        ->with('estaSegui', $estaSegui)
       
         ;
        //return $cotizacion_report;
    
    }

    public function estado(Request $request, Cotizacion_report $cotizacion_report)
    { 
        $segui="Seguimiento";
        $adju="Adjudicado";
        $Pend="Pendiente";
        $parc="Parcial";
        $recha="Rechazado";
        $contar=-1;
        $data=request(); 
        $c=$data['nroMod'];
        $A1=$c;
        $contadorS=0;
            $int=(int)$A1;
            $int=$int+1;
        
            $com=observacion_estados::all('estado');
            $com1=observacion_estados::all('cotizacion_form_id');
            $dato=$cotizacion_report->id;
         $dato=strval($dato);
         $dato='[{"cotizacion_form_id":'.$dato."}";
        $ss1=$data['seguimiento'];
     // return $cotizacion_report->id;
 
        
        
       if ($cotizacion_report->nro==0&&$ss1==$segui) {
        DB::table('observacion_estados')->insert([
            
            'estado'=>$data['seguimiento'],
            'textObs1'=>$data['seguiComen'],
            'textObs2'=>"sin accion",
            'cotizacion_form_id'=>$data['nr'],
            'nroMod'=>$A1,
           
            'created_at'=>date('Y-m-d H:i:s'),  
            'updated_at'=>date('Y-m-d H:i:s'),  
            ]);
            $cotizacion_report->nro=1;
            $cotizacion_report->save();
            return redirect()->back() 

    ->with('success', 'Entrada actualizada.'); 
       }
      

           if ($cotizacion_report->nro==1&&$ss1==$segui) {

            foreach ($com1 as $i) {
                if ($i==$dato&&$ss1==$segui) {
                  $contadorS=$contadorS+1;
                }
                  
              }
              if ($contadorS<=3) {
                DB::table('observacion_estados')->insert([
            
                    'estado'=>$data['seguimiento'],
                    'textObs1'=>$data['seguiComen'],
                    'textObs2'=>"sin accion",
                    'cotizacion_form_id'=>$data['nr'],
                    'nroMod'=>$int,
                    'created_at'=>date('Y-m-d H:i:s'),  
                    'updated_at'=>date('Y-m-d H:i:s'),  
                    ]);
                    return redirect()->back() 

                    ->with('success', 'Entrada actualizada.'); 
              }
              return redirect()->back() 

                    ->with('success', 'muchos intentos');         
        }
        
             

        if ($ss1==$adju) {
            
            DB::table('observacion_estados')->insert([
            
                'estado'=>$data['seguimiento'],
                'textObs1'=>$data['seguiComen'],
                'textObs2'=>"sin accion",
                'cotizacion_form_id'=>$data['nr'],
                'nroMod'=>$int,
                'created_at'=>date('Y-m-d H:i:s'),  
                'updated_at'=>date('Y-m-d H:i:s'),  
                ]);
            $cotizacion_report->nroA=1;
            $cotizacion_report->save();
            return redirect()->back() 

                    ->with('success', 'Entrada actualizada.');
        }

        if ($ss1==$parc) {
            
            DB::table('observacion_estados')->insert([
            
                'estado'=>$data['seguimiento'],
                'textObs1'=>$data['seguiComen'],
                'textObs2'=>"sin accion",
                'cotizacion_form_id'=>$data['nr'],
                'nroMod'=>$int,
                'created_at'=>date('Y-m-d H:i:s'),  
                'updated_at'=>date('Y-m-d H:i:s'),  
                ]);
                $cotizacion_report->nroP=1;
                $cotizacion_report->save();
                return redirect()->back() 

                    ->with('success', 'Entrada actualizada.');
        }
        if ($ss1=="Total") {
            
            DB::table('observacion_estados')->insert([
            
                'estado'=>$data['seguimiento'],
                'textObs1'=>$data['seguiComen'],
                'textObs2'=>"sin accion",
                'cotizacion_form_id'=>$data['nr'],
                'nroMod'=>$int,
                'created_at'=>date('Y-m-d H:i:s'),  
                'updated_at'=>date('Y-m-d H:i:s'),  
                ]);
                $cotizacion_report->nroT=1;
                $cotizacion_report->save();
                return redirect()->back() 

                    ->with('success', 'Entrada actualizada.');
               
        }

        if ($ss1=="Rechazado") {
            
            DB::table('observacion_estados')->insert([
            
                'estado'=>$data['seguimiento'],
                'textObs1'=>$data['seguiComen'],
                'textObs2'=>"sin accion",
                'cotizacion_form_id'=>$data['nr'],
                'nroMod'=>$int,
                'created_at'=>date('Y-m-d H:i:s'),  
                'updated_at'=>date('Y-m-d H:i:s'),  
                ]);
                $cotizacion_report->nro=2;
                
                $cotizacion_report->save();
                return redirect()->back() 

                    ->with('success', 'Entrada actualizada.');
               
        }

     

    }

 




    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cotizacion_report  $cotizacion_report
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cotizacion_report $cotizacion_report)
        { 
            $data=$request;

            $A1=$cotizacion_report->nroMod;
            $int=(int)$A1;
            $int=$int+1;
            
          if ($int<=2) {
            $cotizacion_report->textObs=$data['comentario'];
            $cotizacion_report->user_id=$data['iduser'];
            $cotizacion_report->nroMod=$int;
            $cotizacion_report->fechaC=date('Y-m-d H:i:s');
            $cotizacion_report->save();
            return redirect()->back() 

                    ->with('success', 'Entrada actualizada.');
          } else {
            return redirect()->back() 

                    ->with('success', 'SOLO SE PUEDEN EDITAR 2 VECES.');
          }
          

            
         /**         $data=$request;
        $cont =$data['numero'];
       
        if ($cont<=2) {
            $cont=$cont++;
            if ($cont==1) {
                $cotizacion_report->textObs=$data['descrip"'];
                $cotizacion_report->user_id=$data['iduser'];
                
                $cotizacion_report->nroMod=$cont;
                $cotizacion_report->fechaC=date('Y-m-d H:i:s');
                $cotizacion_report->save();
             
            }
            if ($cont==2) {
                $cotizacion_report->textObs=$data['descrip"'];
                $cotizacion_report->user_id=$data['iduser'];
             
                $cotizacion_report->nroMod=$cont;
                $cotizacion_report->fechaC=date('Y-m-d H:i:s');
                $cotizacion_report->save();
            }
            
       
        } else {
            dd("limite excedido");
        }
        return redirect()->action('CotizacionReportController@store'); 
       */
        return "desde update";
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cotizacion_report  $cotizacion_report
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cotizacion_report $cotizacion_report)
    {
        //
    }
}
