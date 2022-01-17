<?php

namespace App\Http\Controllers\Inventarios;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth; 
use DB;
use App\User;
use App\TomInvProd;
use App\TomInvTom;
use DataTables;
use App\TomInvCont;
use App\TomInvProdUbi;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExcelCollectExport;

class TomaInventarioController extends Controller
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
        return dd("XD");
        if(Auth::user()->tienePermiso(24, 1)){
            $qprod = 
            "SELECT 
            inproCpro,
            inproNomb,
            inproDesc,
            inproMarc,
            inproStat,
            inproCumb
            FROM inpro
            WHERE inproMdel = 0";
            $prod = DB::connection('sqlsrv')->select(DB::raw($qprod));
            return view('inventarios.tomainventario', compact('prod'));
        }
        return redirect()->back();
    }

    public function getProd(Request $request){
        $qprod =
        "WITH produ AS( 
            SELECT 
            inproCpro+inproNomb+inproCodi as busc,
            inproCpro as prod,
            inproNomb as descrip,
            inproCodi as BarCod, 
            inproPcod as BarCodPie,
            inumeAbre as um,
            inumeDesc  as um_desc,
            maconNomb as marca
            FROM inpro
            LEFT JOIN inume ON inumeCume = inproCumb 
            LEFT JOIN macon ON inproMarc = CAST(MaconCcon as varchar)+ '|' + CAST(MaconItem as varchar)
            WHERE inproMdel = 0
        )
        SELECT *  
        FROM produ
        WHERE busc LIKE '%".$request->input('query')."%'
        ";
        $prod = DB::connection('sqlsrv')->select(DB::raw($qprod));
        return response()->json($prod); 
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ingresos(Request $request)
    {
        /*$ingr = TomInvProd::
        select('prod', 'descrip','marca', 'barcod', 'um', 'ubi_id')
        ->selectRaw('SUM(cantidad) as cantidad')
        ->groupBy('prod', 'descrip', 'marca','ubi_id','barcod', 'um')
        ->get();*/
        $tom_id=$request->tom_id;
        $pagf=$request->pag_f;
        $contf = $request->conteo_f;
        $prod = new TomInvProd;
        $prod = $prod->Tomas($tom_id);
        $prodf = $prod->where('hoja', $pagf)->where('cont_id', $contf);
        $pags = $prod->unique('hoja')->pluck('hoja');
        //$ingr = TomInvProd::where('cont_id', $request->cont_id)->get();
        return DataTables::of($prodf)
        ->with([
            "paginas"=>$pags,
         ])
        ->make(); 
    }
    public function paginas(Request $request)
    {
        $tom_id=$request->tom_id;
        $contf = $request->conteo_f;
        $prod = new TomInvProd;
        $prod = $prod->where('cont_id',$contf)->get();
        $pags = $prod->unique('hoja')->pluck('hoja');
        return response()->json($pags);
    }
    public function get_ubi_prod(Request $request)
    {
        $ubic = TomInvProdUbi::where("tom_id",$request->tom_id)->orderBy('nro', 'ASC')->get();
        if($request->getTable){
             return DataTables::of($ubic)->make();
        }
        else{
            return response()->json($ubic);
        }
    }

    public function store_ubi_prod(Request $request){
        $ubia = TomInvProdUbi::where([['nro',$request->nro],['tom_id',$request->tom_id]])->first();
        if($ubia){
            $ubia->descrip = $request->descrip;
            $ubia->save();
        }
        else{
            $ubi = new TomInvProdUbi;
            $ubi->nro  = $request->nro;
            $ubi->descrip = $request->descrip;
            $ubi->tom_id = $request->tom_id;
            $ubi->save();
        }
        return response()->json($ubi);
    }

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

        if($request->nuevo == 1){
            $validated = $request->validate([
                'marca' =>['required', 'string', 'max:255'],
                'descrip'=>['required', 'string', 'max:255'],
                'barcod' =>['nullable','string', 'max:255'],
                'cantidad'=>['required', 'integer', 'min:0'],
                'nuevo'=>['required'],
                'prod_ubi_nro'=>['required'],
            ]);     
            $validated['prod'] = 'NUEVO';
        }
        else if($request->nuevo == 0 || $request->nuevo == 2)
        {
            $validated = $request->validate([
                'prod' => ['required', 'string', 'max:11'],
                'marca' =>['required', 'string', 'max:255'],
                'descrip'=>['required', 'string', 'max:255'],
                'barcod' =>['nullable','string', 'max:255'],
                'cantidad'=>['required', 'integer', 'min:0'],
                'um' =>['required', 'string', 'max:100'],
                'nuevo'=>['required'],
                'prod_ubi_nro'=>['required'],
            ]);
            
        }        
        $cont_id = $request->cont_id;
        $hoja = $request->hoja;
        $prod_ubi = TomInvProdUbi::where([['nro',$request->prod_ubi_nro],['tom_id',$request->tom_id]])->first();
        if($prod_ubi)
        {
            $validated['prod_ubi_id'] = $prod_ubi->id;
        }
        else
        {

            $ubi = new TomInvProdUbi;
            $ubi->nro  = $request->prod_ubi_nro;
            $ubi->descrip = $request->descrip;
            $ubi->tom_id = $request->tom_id;
            $ubi->save();
            $validated['prod_ubi_id'] = $ubi->id;
        }
        $prod = TomInvProd::where([['prod', $validated['prod']], ['cont_id', $cont_id], ['hoja', $hoja]])->get();
        $prod_tot = TomInvProd::where([['cont_id', $cont_id],['hoja', $hoja]])->get();
        if(count($prod_tot)>=18){
            return response()->json(['error'=>'No puede ingresar mas de 18 productos']);
        }
        else{
            if(count($prod) == 0)
            {
                $validated['cont_id'] = $cont_id; 
                $validated['hoja'] = $hoja;
                $prod = TomInvProd::create($validated);
                return response()->json(["success"=>"Se agrego el producto"]);
            }
            else if($request->nuevo == 1)
            {
                $validated['cont_id'] = $cont_id; 
                $validated['hoja'] = $hoja;
                $prod = TomInvProd::create($validated);
                return response()->json(["success"=>"Se agrego el producto Nuevo"]);
            } 
            else{
                return response()->json(['error' => 'El producto ya existe en la hoja']);
            }
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
        if(Auth::user()->tienePermiso(24, 1)){
            $tom = TomInvTom::with(['Funcionarios','Conts.Funcionarios','Sucs', ])->find($id);
            return view('inventarios.tomainventario', compact('tom'));
        }
        return redirect()->back();
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

    public function pdf(Request $request){
        $tom_id=$request->tom_id;
        $tom = TomInvTom::with(['Funcionarios','Conts.Funcionarios','Sucs', 'Conts.Prods' ])->find($tom_id);
        $data = TomInvCont::with(['Funcionarios','Prods','Toma.Sucs'])->where('tom_inv_tom_id', $tom_id)->get();
        //$prod = new TomInvProd;
        //$data = $prod->Tomas($tom_id);
        //$data = $data->groupBy('hoja');
        //return dd($conts);
        //return view('inventarios.pdf', compact('data'));
        $pdf = \PDF::loadView('inventarios.pdf', compact('data'))
        ->setOrientation('landscape')
        ->setPaper('letter')
        ->setOption("encoding","UTF-8")
        ->setOption('footer-font-size',8)
        ->setOption('margin-left','20')
        //->setOption('footer-right','<p>XD</p>')
        ->setOption('margin-right','15')
        ->setOption('margin-top','15')
        ->setOption('margin-bottom','15');
        return $pdf->inline('TomaInventario.pdf');
    }

    public function excel(Request $request){
        $tom_id=$request->tom_id;
        $tom = TomInvTom::with(['Funcionarios','Conts.Funcionarios','Sucs', 'Conts.Prods' ])->find($tom_id);
        $cont = TomInvCont::with(['Funcionarios','Prods.Ubi','Toma.Sucs'])->where('id', $request->cont_id)->first();
        $prods = TomInvProd::with('Ubi')->where('cont_id', $request->cont_id)->get();
        //$prods = TomInvProd::with()
        //return dd(TomInvCont::with(['Funcionarios','Prods','Toma.Sucs'])->where('tom_inv_tom_id', $tom_id)->get());
        $titles = array('ID','CODIGO','MARCA','DESCRIPCION','COD. BARRAS','CANT','UM','CONTEO','HOJA','MODULO');
        $export = new ExcelCollectExport($prods->toArray(), $titles);
        return Excel::download($export, 'TomaInventario '.$tom_id.' - Conteo'.$cont->conteo_id.'.xlsx');        
    }
}
