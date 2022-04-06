<?php

namespace App\Http\Controllers;

use Auth;
use App\DataForm;
use App\LicenciaForm;
use App\FirmaLicencia;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

class LicenciaController extends Controller
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
    if (Auth::user()->rol == 'admin') {
      $forms = LicenciaForm::orderBy('id', 'DESC')
        ->estado($estado)
        ->user($buscar, $dato)
        ->paginate(8);
      return view('licencias_forms', compact('forms'));
    } elseif(Auth::user()->rol != 'admin'){
        $forms = LicenciaForm::orderBy('id', 'DESC')
        ->where('user_id','=',Auth::user()->id)
        ->estado($estado)
        ->paginate(8);
        return view('licencias_forms', compact('forms'));
    } else {
      $forms = LicenciaForm::where('user_id', $user->id)->orderBy('id', 'DESC')
        ->estado($estado)
        ->user($buscar, $dato)
        ->paginate(8);
      return view('licencias_forms', compact('forms'));
    }
  }

  public function estadoForm($id)
  {
    $LicenciaForm = LicenciaForm::find($id);
    return view('forms.licencia_detalle')->with('LicenciaForm', $LicenciaForm);
  }

  public function estado(Request $request, $id)
  {
    $licencia = LicenciaForm::find($id);
    $licencia->estado = $request->get('estado');
    $licencia->save();

    return redirect()->route('licencia.index');
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view("forms.permisos");
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $vaca = LicenciaForm::create([
      'fecha_ini' => $request->fecha_ini . " " . $request->hora_ini,
      'fecha_fin' => $request->fecha_fin . " " . $request->hora_fin,
      'dias' => $request->dias,
      'horas' => $request->horas,
      'motivo' => $request->motivo,
      'respaldo' => $request->respaldo,

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
    $form = LicenciaForm::find($id);
    $firma = $form->firmas->where('tipo', 'Superior')->last();
    $firma_rrhh = $form->firmas->where('tipo', 'RRHH')->last();
    return view('detalle.Permisos', compact('form', 'firma', 'firma_rrhh'));
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
    $form = LicenciaForm::find($id);
    $user = Auth::user();
    if ($user->authorizepermisos(['auth_rrhh_vacacion_form'])) {
      if ($request->aceptadorrhh) {
        $firma = FirmaLicencia::create([
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
        $firma = FirmaLicencia::create([
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
        $firma = FirmaLicencia::create([
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
        $firma = FirmaLicencia::create([
          'user_id' => $user->id,
          'tipo' => 'Superior',
          'estado' => 'RECHAZADO',
          'obs' => $request->obs_r,
        ]);
        $form->firmas()->save($firma);
      }
    }

    return redirect()->route('licencia.index')->with('success', 'El formulario se envio correctamente');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $formulario = LicenciaForm::find($id);
    $formulario->delete();
    return redirect()->route('licencia.index');
  }

  public function generatePDF($id)
  {
    $LicenciaForm = LicenciaForm::find($id);
    $pdf = PDF::loadView('licencia_pdf', compact('LicenciaForm'));
    return $pdf->stream('prueba.pdf');
  }
}
