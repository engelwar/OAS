<?php

namespace App\Http\Controllers;

use Auth;
use App\VacacionForm;
use App\FirmaVacacion;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

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
    public function index(Request $request)
    {
        $user = Auth::user();
        $estado = $request->get('estado');
        $buscar = $request->get('buscar');
        $dato = $request->get('dato');
        if (Auth::user()->authorizePermisos(['auth_vacacion_form', 'auth_vacacion_form'])) {
            $forms = VacacionForm::orderBy('id', 'DESC')
                ->estado($estado)
                ->user($buscar, $dato)
                ->paginate(8);
            return view('vacaciones_forms', compact('forms'));
        } elseif(Auth::user()->rol != 'admin') {
            $forms = VacacionForm::orderby('id', 'DESC')
                ->where('user_id','=',Auth::user()->id)
                ->estado($estado)
                ->paginate(8);
            return view('vacaciones_forms', compact('forms'));
        } elseif (Auth::user()->authorizePermisos(['auth_vacacion_form'])) {
            $forms = VacacionForm::where('user_id', $user->id)->orderBy('id', 'DESC')
                ->estado($estado)
                ->user($buscar, $dato)
                ->paginate(8);
            return view('vacaciones_forms', compact('forms'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("forms.vacaciones");
    }

    public function estadoForm($id)
    {
        $VacacionForm = VacacionForm::find($id);
        return view('forms.vacaciones_detalle')->with('VacacionForm', $VacacionForm);
    }

    public function estado(Request $request, $id)
    {
        $vacacion = VacacionForm::find($id);
        $vacacion->fecha_ini_aut = $request->get('fecha_ini_aut');
        $vacacion->fecha_fin_aut = $request->get('fecha_fin_aut');
        $vacacion->fecha_ret_aut = $request->get('fecha_ret_aut');
        $vacacion->estado = $request->get('estado');
        $vacacion->save();

        return redirect()->route('vacacion.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $vaca = VacacionForm::create([
            'detalle_vacacion' => $request->detalle_vacacion,
            'fecha_ini' => $request->fecha_ini,
            'fecha_fin' => $request->fecha_fin,
            'fecha_ret' => $request->fecha_ret,
            'dias_v' => $request->dias_v,
            'dias_v_l' => $request->dias_v_l,
            'dias' => $request->dias,
            'dias_l' => $request->dias_l,
            'saldo_dias' => $request->saldo_dias,
            'saldo_dias_l' => $request->saldo_dias_l,

            'user_id' => Auth::user()->id,
        ]);
        return redirect()->route('inicio.index')->with('success', 'El formulario se envio correctamente');
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
        $form = VacacionForm::find($id);
        $user = Auth::user();
        if ($user->authorizepermisos(['auth_rrhh_vacacion_form'])) {
            if ($request->aceptadorrhh) {
                $firma = FirmaVacacion::create([
                    'user_id' => $user->id,
                    'tipo' => 'RRHH',
                    'estado' => 'ACEPTADO',
                    'obs' => $request->obs_a_rrhh,
                ]);
                $form->firmas()->save($firma);
            }
            if ($request->rechazadorrhh) {
                /*$error=$request->validate([
                    'obs' => 'required|max:255',
                ]);*/
                $firma = FirmaVacacion::create([
                    'user_id' => $user->id,
                    'tipo' => 'RRHH',
                    'estado' => 'RECHAZADO',
                    'obs' => $request->obs_r_rrhh,
                ]);
                $form->firmas()->save($firma);
            }
        }
        if ($user->authorizepermisos(['auth_vacacion_form'])) {
            if ($request->aceptado) {
                $firma = FirmaVacacion::create([
                    'user_id' => $user->id,
                    'tipo' => 'Superior',
                    'estado' => 'ACEPTADO',
                    'obs' => $request->obs_a,
                ]);
                $form->firmas()->save($firma);
            }
            if ($request->rechazado) {
                /*$error=$request->validate([
                    'obs' => 'required|max:255',
                ]);*/
                $firma = FirmaVacacion::create([
                    'user_id' => $user->id,
                    'tipo' => 'Superior',
                    'estado' => 'RECHAZADO',
                    'obs' => $request->obs_r,
                ]);
                $form->firmas()->save($firma);
            }
        }

        return redirect()->route('vacacion.index')->with('success', 'El formulario se envio correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $formulario = VacacionForm::find($id);
        $formulario->delete();
        return redirect()->route('vacacion.index');
    }

    public function generatePDF($id)
    {
        $VacacionForm = VacacionForm::find($id);
        $pdf = PDF::loadView('vacacion_pdf', compact('VacacionForm'));
        return $pdf->stream('prueba.pdf');
    }
}
