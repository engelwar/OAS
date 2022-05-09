<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use DataTables; 

class KardexReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = 
        "SELECT inalmCalm as id, inalmNomb as alm
        FROM inalm
        WHERE 
        inalmCalm IN
        (
            SELECT intraCalm
            FROM intra 
            WHERE intraMdel = 0
            GROUP BY intraCalm
        )
        ORDER BY inalmNomb";
        $almacenes = DB::connection('sqlsrv')->select(DB::raw($query));
        return view('reports.kardex_report', compact('almacenes')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function products(Request $request){
        $alm = $request->alm;
        $query = 
        "WITH tab AS
        (
            SELECT 
            intrdCpro as Prod,
            intraCalm as Calm,
            intrdCanb, 
            intrdCTmi,
            CASE WHEN intraTtra = 1 THEN 1 ELSE 0 END ingreso,
            CASE WHEN intraTtra = 2 THEN 1 ELSE 0 END salida,
            insalCupb,
            CASE WHEN intrdCanb = 0 THEN 0
            ELSE
            ABS((intrdCTmi/intrdCanb)-insalCupb)
            END
            as dif
            FROM intra
            JOIN intrd ON intraNTra = intrdNtra AND intraMdel = 0 
            LEFT JOIN insal ON insalCpro = intrdCpro AND intraCalm = insalCalm
        )
        SELECT 
        Prod, 
        inalmNomb as alm,
        CASE SUM(intrdCanb)
        WHEN 0 THEN CAST(0 as money)
        ELSE CAST(SUM(intrdCTmi)/SUM(intrdCanb) as money)
        END as CostProm,
        CONVERT(varchar, CAST(insalCupb as money), 1) as costo,
        CONVERT(varchar, CAST(SUM(dif) as money),1) as dif,
        CONVERT(varchar, CAST(MAX(dif) as money),1) as difmax,
        SUM(ingreso) as ingresos,
        SUM(salida) as salidas
        FROM tab
        JOIN inalm ON inalmCalm = Calm    
        WHERE Calm = ".$alm."
        GROUP BY Prod, inalmNomb, inalmCalm, insalCupb
        --HAVING AVG(dif) <> 0
        ";
        $ventas = DB::connection('sqlsrv')->select(DB::raw($query)); 
        return Datatables::of($ventas)
        ->with([
            "titulos"=>"XD"
         ])
        ->make(); 
    }
    
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $prod = $request->prod;
        $alm = $request->alm;
        $query = 
        "DECLARE @Cpro nvarchar(9),@Calm int
        SELECT @Cpro = 'PBOBRE020', @Calm = 4
        --SELECT @Cpro = '".$prod."', @Calm = '".$alm."'
        SELECT intrdNtra, intrdClot, intrdCpro, intrdItem, 
        case when intrdCanT > 0 then intrdCanT else 0 end as positivo,
        case when intrdCanT > 0 then Case 
            When intrdCanb = 0 Then 0 
            Else intrdCTmi/intrdCanb 
            End else 0 end as CostPos,
        case when intrdCanT > 0 then intrdCTmt else 0 end as TotPos,
        case when intrdCanT < 0 then intrdCanT else 0 end as negativo,
        case when intrdCanT < 0 then Case 
            When intrdCanb = 0 Then 0 
            Else intrdCTmi/intrdCanb 
            End else 0 end as CostNeg,
        case when intrdCanT < 0 then intrdCTmt else 0 end as TotNeg,
        intrdUmtr, intrdCanb, intrdUmbs,         
        intrdCTmi, intrdMtra, intrdMinv, intrdTipo, intrdMdel,intraNtrI as _Ntri, intraTtra as _Ttra, 
        intraTmov as _Tmov,          
        intraFtra as _Ftra, intraCalm as _Calm , 
        Case 
            When intrdCanb = 0 Then 0 
            Else intrdCTmi/intrdCanb 
            End as _CostUnit, 
        inproCumb as _Cumb,           
        admonAbrv as _admonAbrv, 
        CAST (0.0 as float) _CantAcum, 
        CAST (0.0 as float) _CostAvg, 
        CAST (0.0 as float) _Diferencia,
        CAST (0.0 as float) _CostAcum
        into #Mov_Prod  
        FROM intra             
        JOIN intrd On (intraNtra = intrdNtra And intrdMdel = 0)              
        JOIN inpro On (intrdCpro = inproCpro)              
        JOIN inalm On (intraCalm = inalmCalm)              
        JOIN bd_admOlimpia.dbo.admon  ON (intrdMinv = admonCmon)  
        WHERE intraMdel = 0 And intrdCanb <> 0 And inproCpro = @Cpro 
        AND inalmCalm = @Calm  
        ORDER BY  intraFtra,intraNtra   
                        
        DECLARE @CantidadUpdate as float, @CantidadUpdAnt as float,
        @CostUPB as float, @CostUPBAnt as float, @Diferencia as float,
        @CostoUpdate as float, @CostoUpdAnt as float
                
        DECLARE @CodProd as varchar(50), @item As Integer, @Ntra As Integer     
        DECLARE @Positivo as float, @Negativo as float, @CostoUnit as float, @CostTot as float  
                
        DECLARE MovProd_CURSOR 
        CURSOR FOR SELECT intrdCpro, intrdItem, intrdNtra, positivo, negativo,_CostUnit,intrdCTmi
        FROM #Mov_Prod 
        ORDER BY  _Ftra, intrdNtra      
                
        OPEN MovProd_CURSOR  
                
        FETCH NEXT FROM MovProd_CURSOR INTO @CodProd,@item,@Ntra,@Positivo,@Negativo,@CostoUnit,@CostTot   
                
        SET @CantidadUpdAnt = 0  
        SET @CostoUpdAnt = 0 
        DECLARE @IsFirstRow as bit = 1
                
        WHILE @@FETCH_STATUS = 0      
        BEGIN      
        SET @CantidadUpdate = @CantidadUpdAnt + @Positivo + @Negativo;    
        SET @CostoUpdate = @CostoUpdAnt + @CostTot; 
        IF (@IsFirstRow = 1) 
            BEGIN              
                SET @CostUPB = @CostTot / (@Positivo + @Negativo);              
                SET @IsFirstRow= 0;         
            END 
        ELSE 
            BEGIN            
                IF( ABS(ROUND(@CantidadUpdate,6))= 0 ) 
                    BEGIN               
                        SET   @CantidadUpdate=0               
                    END     
                IF( ABS(ROUND(@CostoUpdate,6))= 0 ) 
                    BEGIN               
                        SET   @CostoUpdate=0               
                    END  
                If (@Positivo>0 AND  @CantidadUpdate > 0) 
                    BEGIN                  
                        SET @CostUPB = (@CostTot + (@CostUPBAnt * @CantidadUpdAnt)) / @CantidadUpdate;              
                    END 
                ELSE 
                    BEGIN                  
                        SET @CostUPB = @CostUPBAnt;              
                    END          
            END          
        SET @CostUPB = ROUND(@CostUPB,5);          
        SET @CostoUnit = ROUND(@CostoUnit,5);         
        SET @Diferencia = @CostUPB - @CostoUnit;          
        SET @CostUPBAnt = @CostUPB;     
        SET @CantidadUpdAnt = @CantidadUpdate;      
        SET @CostoUpdAnt = @CostoUpdate; 

        UPDATE #Mov_Prod SET _CantAcum=@CantidadUpdate, _CostAvg=@CostUPB, _Diferencia=@Diferencia, _CostAcum = @CostoUpdate          
        WHERE intrdCpro=@CodProd AND intrdItem=@item AND intrdNtra=@Ntra 
                
        FETCH NEXT FROM MovProd_CURSOR            
        INTO @CodProd,@item,@Ntra,@Positivo,@Negativo,@CostoUnit,@CostTot       
        END         
        CLOSE MovProd_CURSOR;        
        DEALLOCATE MovProd_CURSOR;      
        ";
        $insert = DB::connection('sqlsrv')->unprepared(DB::raw($query));

        $movimientos = DB::connection('sqlsrv')
        ->select(DB::raw(
        "SELECT 
        intrdCpro as _Cpro,
        inproNomb as ProdDesc,
        intrdNtra as _Ntra,
        CONVERT(varchar,_Ftra,103) as _Ftra,
        positivo as _CanA,
        CONVERT(varchar, CAST(costpos as decimal(10,4)),1) as _CosP,
        CONVERT(varchar, CAST(totpos as decimal(10,4)),1) as _TotP,
        negativo as _CanB,
        CONVERT(varchar, CAST(costneg as decimal(10,4)),1) as _CosN,
        CONVERT(varchar, CAST(totneg as decimal(10,4)),1) as _TotN,
        CONVERT(varchar, CAST(intrdCTmi as decimal(10,4)),1) as _CTmi,
        CONVERT(varchar, CAST(_CostAcum as decimal(10,4)),1) as _CostAcum,
        --CONVERT(varchar, CAST(intrdCTmt as money),1) as _CTmt,        
        --intrdCant as _Cant,
        --intrdClot as _Clot,        
        --intrdItem as _Item,
        --intrdMdel as _Mdel,
        --intrdMinv as _Minv,
        _admonAbrv,
        --intrdMtra as _Mtra,       
        --intrdTipo as _Tipo,
        --intrdUmbs as _Umbs,
        --intrdUmtr as _Umtr,
        _Calm,
        _CantAcum,
        CONVERT(varchar, CAST(_CostAvg as decimal(10,4)),1) as _CostAvg,        
        _Cumb,
        CONVERT(varchar, CAST(_Diferencia as decimal(10,4)),1) as _Diferencia,
        _Ntri,
        maTmoNomb as _TmovN,
        _Ttra as Ttra
        FROM #Mov_Prod
        JOIN maTmo ON _Tmov = maTmoItem
        LEFT JOIN inpro ON inproCpro = intrdCpro
        ORDER BY _Ntra, _Ftra
        ")); 
        // return response()->json($movimientos);

        $array = [];
        foreach($movimientos as $i => $val){
          if($i == 0){
            $array[] = ['_Cpro' => $val->_Cpro, 'ProdDesc' => $val->ProdDesc, '_Ntra' => $val->_Ntra, '_Ftra' => $val->_Ftra, '_CanA' => $val->_CanA, '_CosP' => $val->_CosP, '_TotP' => $val->_TotP, '_CanB' => $val->_CanB, '_CosN' => $val->_CosN, '_TotN' => $val->_TotN,'_SalCan' => ($val->_CanA + $val->_CanB), '_SalCos' => ($val->_CosP + $val->_CosN), '_SalTot' => ($val->_TotP + $val->_TotN), '_CTmi' => $val->_CTmi, '_CostAcum' => $val->_CostAcum, '_admonAbrv' => $val->_admonAbrv, '_Calm' => $val->_Calm, '_CantAcum' => $val->_CantAcum, '_CostAvg' => $val->_CostAvg, '_Cumb' => $val->_Cumb, '_Diferencia' => $val->_Diferencia, '_Ntri' => $val->_Ntri, '_TmovN' => $val->_TmovN, 'Ttra' => $val->Ttra];
          } else {
            $array[] = ['_Cpro' => $val->_Cpro, 'ProdDesc' => $val->ProdDesc, '_Ntra' => $val->_Ntra, '_Ftra' => $val->_Ftra, '_CanA' => $val->_CanA, '_CosP' => $val->_CosP, '_TotP' => $val->_TotP, '_CanB' => $val->_CanB, '_CosN' => $val->_CosN, '_TotN' => $val->_TotN,'_SalCan' => ($val->_CanA + $val->_CanB + $array[$i-1]['_SalCan']), '_SalCos' => ($val->_CosP + $val->_CosN + $array[$i-1]['_SalCos']), '_SalTot' => ($val->_TotP + $val->_TotN + $array[$i-1]['_SalTot']), '_CTmi' => $val->_CTmi, '_CostAcum' => $val->_CostAcum, '_admonAbrv' => $val->_admonAbrv, '_Calm' => $val->_Calm, '_CantAcum' => $val->_CantAcum, '_CostAvg' => $val->_CostAvg, '_Cumb' => $val->_Cumb, '_Diferencia' => $val->_Diferencia, '_Ntri' => $val->_Ntri, '_TmovN' => $val->_TmovN, 'Ttra' => $val->Ttra];
          }
        }

        $produ = 
        "SELECT inproCpro as Produ, inproNomb as ProdNomb 
        FROM inpro WHERE inproMDel = 0 AND inproCpro = '".$prod."'";
        $produ = DB::connection('sqlsrv')->select($produ);
        return Datatables::of($array)
        ->with([
            "producto"=>$produ[0],
        ])
        ->make(); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $query = 
        "DECLARE @Cpro nvarchar(9),@Calm int
        SELECT @Cpro = 'PBOBRE020', @Calm = 4
        SELECT intrdNtra, intrdClot, intrdCpro, intrdItem, 
        case when intrdCanT > 0 then intrdCanT else 0 end as positivo,
        case when intrdCanT > 0 then Case 
            When intrdCanb = 0 Then 0 
            Else intrdCTmi/intrdCanb 
            End else 0 end as CostPos,
        case when intrdCanT > 0 then intrdCTmt else 0 end as TotPos,
        case when intrdCanT < 0 then intrdCanT else 0 end as negativo,
        case when intrdCanT < 0 then Case 
            When intrdCanb = 0 Then 0 
            Else intrdCTmi/intrdCanb 
            End else 0 end as CostNeg,
        case when intrdCanT < 0 then intrdCTmt else 0 end as TotNeg,
        intrdUmtr, intrdCanb, intrdUmbs,         
        intrdCTmi, intrdMtra, intrdMinv, intrdTipo, intrdMdel,intraNtrI as _Ntri, intraTtra as _Ttra, 
        intraTmov as _Tmov,          
        intraFtra as _Ftra, intraCalm as _Calm , 
        Case 
            When intrdCanb = 0 Then 0 
            Else intrdCTmi/intrdCanb 
            End as _CostUnit, 
        inproCumb as _Cumb,           
        admonAbrv as _admonAbrv, 
        CAST (0.0 as float) _CantAcum, 
        CAST (0.0 as float) _CostAvg, 
        CAST (0.0 as float) _Diferencia,
        CAST (0.0 as float) _CostAcum
        into #Mov_Prod  
        FROM intra             
        JOIN intrd On (intraNtra = intrdNtra And intrdMdel = 0)              
        JOIN inpro On (intrdCpro = inproCpro)              
        JOIN inalm On (intraCalm = inalmCalm)              
        JOIN bd_admOlimpia.dbo.admon  ON (intrdMinv = admonCmon)  
        WHERE intraMdel = 0 And intrdCanb <> 0 And inproCpro = @Cpro 
        AND inalmCalm = @Calm  
        ORDER BY  intraFtra,intraNtra   
                        
        DECLARE @CantidadUpdate as float, @CantidadUpdAnt as float,
        @CostUPB as float, @CostUPBAnt as float, @Diferencia as float,
        @CostoUpdate as float, @CostoUpdAnt as float
                
        DECLARE @CodProd as varchar(50), @item As Integer, @Ntra As Integer     
        DECLARE @Positivo as float, @Negativo as float, @CostoUnit as float, @CostTot as float  
                
        DECLARE MovProd_CURSOR 
        CURSOR FOR SELECT intrdCpro, intrdItem, intrdNtra, positivo, negativo,_CostUnit,intrdCTmi
        FROM #Mov_Prod 
        ORDER BY  _Ftra, intrdNtra      
                
        OPEN MovProd_CURSOR  
                
        FETCH NEXT FROM MovProd_CURSOR INTO @CodProd,@item,@Ntra,@Positivo,@Negativo,@CostoUnit,@CostTot   
                
        SET @CantidadUpdAnt = 0  
        SET @CostoUpdAnt = 0 
        DECLARE @IsFirstRow as bit = 1
                
        WHILE @@FETCH_STATUS = 0      
        BEGIN      
        SET @CantidadUpdate = @CantidadUpdAnt + @Positivo + @Negativo;    
        SET @CostoUpdate = @CostoUpdAnt + @CostTot; 
        IF (@IsFirstRow = 1) 
            BEGIN              
                SET @CostUPB = @CostTot / (@Positivo + @Negativo);              
                SET @IsFirstRow= 0;         
            END 
        ELSE 
            BEGIN            
                IF( ABS(ROUND(@CantidadUpdate,6))= 0 ) 
                    BEGIN               
                        SET   @CantidadUpdate=0               
                    END     
                IF( ABS(ROUND(@CostoUpdate,6))= 0 ) 
                    BEGIN               
                        SET   @CostoUpdate=0               
                    END  
                If (@Positivo>0 AND  @CantidadUpdate > 0) 
                    BEGIN                  
                        SET @CostUPB = (@CostTot + (@CostUPBAnt * @CantidadUpdAnt)) / @CantidadUpdate;              
                    END 
                ELSE 
                    BEGIN                  
                        SET @CostUPB = @CostUPBAnt;              
                    END          
            END          
        SET @CostUPB = ROUND(@CostUPB,5);          
        SET @CostoUnit = ROUND(@CostoUnit,5);         
        SET @Diferencia = @CostUPB - @CostoUnit;          
        SET @CostUPBAnt = @CostUPB;     
        SET @CantidadUpdAnt = @CantidadUpdate;      
        SET @CostoUpdAnt = @CostoUpdate; 

        UPDATE #Mov_Prod SET _CantAcum=@CantidadUpdate, _CostAvg=@CostUPB, _Diferencia=@Diferencia, _CostAcum = @CostoUpdate          
        WHERE intrdCpro=@CodProd AND intrdItem=@item AND intrdNtra=@Ntra 
                
        FETCH NEXT FROM MovProd_CURSOR            
        INTO @CodProd,@item,@Ntra,@Positivo,@Negativo,@CostoUnit,@CostTot       
        END         
        CLOSE MovProd_CURSOR;        
        DEALLOCATE MovProd_CURSOR;      
        ";
        $insert = DB::connection('sqlsrv')->unprepared(DB::raw($query));

        $movimientos = DB::connection('sqlsrv')
        ->select(DB::raw(
        "SELECT 
        intrdCpro as _Cpro,
        inproNomb as ProdDesc,
        intrdNtra as _Ntra,
        CONVERT(varchar,_Ftra,103) as _Ftra,
        positivo as _CanA,
        CONVERT(varchar, CAST(costpos as decimal(10,4)),1) as _CosP,
        CONVERT(varchar, CAST(totpos as decimal(10,4)),1) as _TotP,
        negativo as _CanB,
        CONVERT(varchar, CAST(costneg as decimal(10,4)),1) as _CosN,
        CONVERT(varchar, CAST(totneg as decimal(10,4)),1) as _TotN,
        CONVERT(varchar, CAST(intrdCTmi as decimal(10,4)),1) as _CTmi,
        CONVERT(varchar, CAST(_CostAcum as decimal(10,4)),1) as _CostAcum,
        --CONVERT(varchar, CAST(intrdCTmt as money),1) as _CTmt,        
        --intrdCant as _Cant,
        --intrdClot as _Clot,        
        --intrdItem as _Item,
        --intrdMdel as _Mdel,
        --intrdMinv as _Minv,
        _admonAbrv,
        --intrdMtra as _Mtra,       
        --intrdTipo as _Tipo,
        --intrdUmbs as _Umbs,
        --intrdUmtr as _Umtr,
        _Calm,
        _CantAcum,
        CONVERT(varchar, CAST(_CostAvg as decimal(10,4)),1) as _CostAvg,        
        _Cumb,
        CONVERT(varchar, CAST(_Diferencia as decimal(10,4)),1) as _Diferencia,
        _Ntri,
        maTmoNomb as _TmovN,
        _Ttra as Ttra
        FROM #Mov_Prod
        JOIN maTmo ON _Tmov = maTmoItem
        LEFT JOIN inpro ON inproCpro = intrdCpro
        ORDER BY _Ntra, _Ftra
        "));
        $array = [];
        foreach($movimientos as $i => $val){
          if($i == 0){
            $array[] = ['_Cpro' => $val->_Cpro, 'ProdDesc' => $val->ProdDesc, '_Ntra' => $val->_Ntra, '_Ftra' => $val->_Ftra, '_CanA' => $val->_CanA, '_CosP' => $val->_CosP, '_TotP' => $val->_TotP, '_CanB' => $val->_CanB, '_CosN' => $val->_CosN, '_TotN' => $val->_TotN,'_SalCan' => ($val->_CanA + $val->_CanB), '_SalCos' => ($val->_CosP + $val->_CosN), '_SalTot' => ($val->_TotP + $val->_TotN), '_CTmi' => $val->_CTmi, '_CostAcum' => $val->_CostAcum, '_admonAbrv' => $val->_admonAbrv, '_Calm' => $val->_Calm, '_CantAcum' => $val->_CantAcum, '_CostAvg' => $val->_CostAvg, '_Cumb' => $val->_Cumb, '_Diferencia' => $val->_Diferencia, '_Ntri' => $val->_Ntri, '_TmovN' => $val->_TmovN, 'Ttra' => $val->Ttra];
          } else {
            $array[] = ['_Cpro' => $val->_Cpro, 'ProdDesc' => $val->ProdDesc, '_Ntra' => $val->_Ntra, '_Ftra' => $val->_Ftra, '_CanA' => $val->_CanA, '_CosP' => $val->_CosP, '_TotP' => $val->_TotP, '_CanB' => $val->_CanB, '_CosN' => $val->_CosN, '_TotN' => $val->_TotN,'_SalCan' => ($val->_CanA + $val->_CanB + $array[$i-1]['_SalCan']), '_SalCos' => ($val->_CosP + $val->_CosN + $array[$i-1]['_SalCos']), '_SalTot' => ($val->_TotP + $val->_TotN + $array[$i-1]['_SalTot']), '_CTmi' => $val->_CTmi, '_CostAcum' => $val->_CostAcum, '_admonAbrv' => $val->_admonAbrv, '_Calm' => $val->_Calm, '_CantAcum' => $val->_CantAcum, '_CostAvg' => $val->_CostAvg, '_Cumb' => $val->_Cumb, '_Diferencia' => $val->_Diferencia, '_Ntri' => $val->_Ntri, '_TmovN' => $val->_TmovN, 'Ttra' => $val->Ttra];
          }
        }
        dd($movimientos);
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
