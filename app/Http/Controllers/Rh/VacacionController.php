<?php

namespace App\Http\Controllers\Rh;

use Auth;
use App\Http\Controllers\Controller;
use App\VacacionForm;
use App\Firma;
use Illuminate\Http\Request;
use Convertidor;


class VacacionController extends Controller
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
                $forms=VacacionForm::orderBy('id','DESC')
                ->paginate(8);  
                return view('rrhh.vacaciones_forms',compact('forms'));

            $forms=VacacionForm::where('user_id', $user->id)->orderBy('id','DESC')
                ->paginate(8);  
                return view('rrhh.vacaciones_forms',compact('forms'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user()->dias_vacacion;
        $numero=$user;
        $dias = Convertidor::numtoLetras($numero);
        return view("forms.vacaciones", compact('dias'));            
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $vaca= VacacionForm::create([
            'fecha_ini'=>$request->fecha_ini,
            'fecha_fin'=>$request->fecha_fin,
            'fecha_ret'=>$request->fecha_ret,
            'dias_v'=>$request->dias_v,
            'dias_v_l'=>$request->dias_v_l,
            'dias'=>$request->dias,
            'dias_l'=>$request->dias_l,
            'saldo_dias'=>$request->saldo_dias,
            'saldo_dias_l'=>$request->saldo_dias_l,
            'user_id'=>Auth::user()->id,
        ]);
        return redirect()->route('inicio')->with('success','El formulario se envio correctamente');
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
        $form = VacacionForm::find($id);      
        $firma = $form->firmas->where('tipo', 'Superior')->last();
        $firma_rrhh = $form->firmas->where('tipo', 'RRHH')->last();
        return view('detalle.vacaciones', compact('form', 'firma', 'firma_rrhh'));
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
        $form=VacacionForm::find($id);
        $user=Auth::user();
        if($user->authorizepermisos(['auth_rrhh_vacacion_form']))
        {
            if($request->aceptadorrhh)
            {
                $firma= Firma::create([
                    'user_id'=>$user->id,
                    'tipo'=>'RRHH',
                    'estado'=>'ACEPTADO',
                    'obs'=>$request->obs_a_rrhh,
                ]);  
                $form->firmas()->save($firma);      
            } 
            if($request->rechazadorrhh)
            {
                /*$error=$request->validate([
                    'obs' => 'required|max:255',
                ]);*/
                $firma= Firma::create([
                    'user_id'=>$user->id,
                    'tipo'=>'RRHH',
                    'estado'=>'RECHAZADO',
                    'obs'=>$request->obs_r_rrhh,
                ]);
                $form->firmas()->save($firma);
            }
            
        }
        if($user->authorizepermisos(['auth_vacacion_form']))
        {   
            if($request->aceptado)
            { 
                $firma= Firma::create([
                    'user_id'=>$user->id,
                    'tipo'=>'Superior',
                    'estado'=>'ACEPTADO',
                    'obs'=>$request->obs_a,
                ]);
                $form->firmas()->save($firma);
            }
            if($request->rechazado)
            {
                /*$error=$request->validate([
                    'obs' => 'required|max:255',
                ]);*/
                $firma= Firma::create([
                    'user_id'=>$user->id,
                    'tipo'=>'Superior',
                    'estado'=>'RECHAZADO',
                    'obs'=>$request->obs_r,
                ]); 
                $form->firmas()->save($firma);
            } 
            
        }   
         
        return redirect()->route('vacacion.index')->with('success','El formulario se envio correctamente');    
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

    public function pdf($id)
    {
        $form = VacacionForm::find($id); 
        $firma = $form->firmas->where('tipo', 'Superior')->last();
        $firma_rrhh = $form->firmas->where('tipo', 'RRHH')->last();
        //$pdf = app('dompdf.wrapper');
        $data = [
            'titulo' => 'Vacacion'
        ];
        //return storage_path("fonts/light.ttf");
        $pdf = \PDF::setPaper('letter')->loadView('pdf.vacaciones', compact('form', 'firma', 'firma_rrhh'));
        return $pdf->stream('archivo.pdf');
    }
}
