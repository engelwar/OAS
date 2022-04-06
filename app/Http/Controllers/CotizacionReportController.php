<?php

namespace App\Http\Controllers;

use App\Cotizacion_report;
use Illuminate\Http\Request;
use App\User;
use DB;
use PDF;
use Auth;


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
        return view('cotizacionReport.vistaCotizacionReport', compact('user'));
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
        //
    }

    //mostrar pdf
    public function verPDF()
    {
        return redirect('reports.pdf.cotizacionReportPdf');
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
      
        $esUnaQuery = 
        " 
        select  CONVERT(varchar,vtvtaFtra,103) as 'Fecha',
		vtvtaNcot as 'NroCotizacion',
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
        ON imlvtnvta = vtvtantra AND imlvtmdel=0
	
order by vtvtaFent desc
        
        ";
       
         $consutas = DB::connection('sqlsrv')->select(DB::raw($esUnaQuery));

         $nombre = 'Fernando';
    
        return view('reports.pdf.prueba')
        
                ->with('nombre', $nombre)
                ->with('consultas',$consutas);
               
                
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
        //
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
