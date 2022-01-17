<?php

namespace App\Http\Controllers\Contabilidad;

use App\Http\Controllers\Controller;
use App\RendicionGastosForm;
use App\RendicionGastosDataForm;
use App\RendicionFondoFijoForm;
use App\RendicionFondoFijoDataForm;
use App\SolicitudGasto;
use Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;

class RendicionGastosController extends Controller
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
        $user = Auth::user();
        $gastos=RendicionGastosForm::where('user_id', $user->id)->orderBy('id','DESC')
        ->paginate(8);  
        $solicitud = SolicitudGasto::where('perfil_id', $user->perfiles->id )
        ->orderBy('id','DESC')
        ->get();
        return view('gastos.index',compact('gastos', 'solicitud'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $cont)
    {      
        $fondofijo=RendicionFondoFijoForm::where([['unidad_id', Auth::user()->perfiles->unidades->id],['estado',0]])->latest()->first(); 
        if($fondofijo)
        {  
            $gastos = RendicionGastosForm::where('user_id', Auth::user()->id)
            ->latest()
            ->first();
            if($gastos==NULL)
            {
                $date = date('Y-m-d');
                $n_date= date("N");
                if($n_date>=5)
                {
                    $desde = date('Y-m-d', strtotime($date.'-'.($n_date-5).' days'));
                }
                else
                {
                    $desde = date('Y-m-d', strtotime($date.'-'.($n_date+2).' days'));
                    
                } 
                $hasta = date('Y-m-d', strtotime($desde.'+7 days'));
                return view("gastos.create", compact('cont', 'desde', 'hasta')); 
                 
            }
            elseif(date('Y-m-d') >= $gastos->fecha_ini && date('Y-m-d') < $gastos->fecha_fin)
            {
                return redirect()->route('rendiciongastos.edit',$gastos->id);            
            }      
        }  
        else
        {
            return dd("Aun no existe su fondo fijo");
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
          
        $fondofijo=RendicionFondoFijoForm::where([['unidad_id', Auth::user()->perfiles->unidades->id],['estado',0]])->latest()->first(); 
        if($fondofijo)
        {
            $date = date('Y-m-d');
            $n_date= date("N");
            //$date = date('Y-m-d', strtotime('01/15/2021'));
            //$n_date= date('N', strtotime('01/15/2021'));
            if($n_date>=5)
            {
                $desde = date('Y-m-d', strtotime($date.'-'.($n_date-5).' days'));
            }
            else
            {
                $desde = date('Y-m-d', strtotime($date.'-'.($n_date+2).' days'));
                
            } 
            $hasta = date('Y-m-d', strtotime($desde.'+7 days')); 
            $user=Auth::user(); 
            $form = RendicionGastosForm::create([
                'user_id'=>Auth::user()->id,
                'fecha_ini' => $desde,
                'fecha_fin' => $hasta
            ]);
            $fondofijo=RendicionFondoFijoForm::where([['unidad_id', Auth::user()->perfiles->unidades->id],['estado',0]])->latest()->first();  
            foreach ($request->fecha as $f =>$k) {                     
                $fondofijodata = RendicionFondoFijoDataForm::create([
                'fecha'=>$request->fecha[$f],
                'centro_c'=>$request->centro_c[$f],
                'cuenta_c'=>$request->cuenta_c[$f],
                'razon_s'=>$request->razon_s[$f],
                'concepto'=>$request->detalle[$f],
                'n_fac'=>$request->no_fac[$f],
                //'n_recib'=>"",
                //'debe'=>$request->debe[$i],
                'haber'=>$request->monto[$f],
                //'saldo'=>"",
                'user_id'=>Auth::user()->id,
                'fondo_id'=>$fondofijo->id,
                'tipo'=>'gasto',
                'gasto_id'=>$form->id,
                'saldo'=>0,
                ]);   
                $form->fondofijodata()->attach($fondofijodata->id);
            }
            return redirect()->route('home')->with('success','El formulario se envio correctamente');
        }
        else{
            return dd("aun no existe su fondo fijo");
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
        $cont=1;
        $form = RendicionGastosForm::find($id);   
        $gastos = $form->fondofijodata;
        return view('gastos.edit', compact('cont','form','gastos'));
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
