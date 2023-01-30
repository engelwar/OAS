<?php

namespace App\Http\Controllers;

use App\SolicitudAnulacion;
use App\Perfil;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\Controller;
use DB;
use GuzzleHttp\RetryMiddleware;
use Illuminate\Foundation\Auth\User;

class SolicitudAnuladasController extends Controller
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
    //
  }
  public function ticker(Request $request)
  {
    return dd("desde ticker");
   // $busca = $request->get('busca');
   // $cot = SolicitudAnulacion::orderBy('id', 'DESC')
   //   ->paginate(30);
   // return view("forms.SolicitudAnuladas", compact('cot', 'busca'));
    // if (Auth::user()->tienePermiso(44, 1)) {
    //   if (Auth::user()->tienePermiso(44,4)) {
    //   } else {
    //     $busca = $request->get('busca');
    //     $cot = SolicitudAnulacion::orderBy('id', 'DESC')
    //       ->where('user_id','=',Auth::user()->id)
    //       ->paginate(30);
    //     return view("forms.SolicitudAnuladas", compact('cot', 'busca'));
    //   }
    // } else {
    //   return dd("no tiene acceso al formulario");
    // }
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create(Request $request)
  {
    $busca = $request->get('busca');
    $cot = SolicitudAnulacion::orderBy('id', 'DESC')
      ->paginate(30);
    return view("forms.SolicitudAnuladas", compact('cot', 'busca'));
    // if (Auth::user()->tienePermiso(44, 1)) {
    //   if (Auth::user()->tienePermiso(44,4)) {
    //   } else {
    //     $busca = $request->get('busca');
    //     $cot = SolicitudAnulacion::orderBy('id', 'DESC')
    //       ->where('user_id','=',Auth::user()->id)
    //       ->paginate(30);
    //     return view("forms.SolicitudAnuladas", compact('cot', 'busca'));
    //   }
    // } else {
    //   return dd("no tiene acceso al formulario");
    // }
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $cotizacion = SolicitudAnulacion::create([
      'fechaemision' => $request->fechaemision,
      'factura_remision' => $request->factura_remision,
      'cliente' => $request->cliente,
      'importe' => $request->importe,
      'motivo' => $request->motivo,
      'user_id' => Auth::user()->id,
      'estado' => $request->estado,
    ]);

    return redirect()->route('solicitudanuladas.create')->with('success', 'El formulario se envio correctamente');
  }
  public function inserdatos(Request $request)
  {
    $cotizacion = SolicitudAnulacion::create([
      'fechaemision' => $request->fechaemision,
      'factura_remision' => $request->factura_remision,
      'cliente' => $request->cliente,
      'importe' => $request->importe,
      'motivo' => $request->motivo,
      'user_id' => Auth::user()->id,
      'estado' => $request->estado,
    ]);

    return redirect()->route('solicitudanuladas.create')->with('success', 'El formulario se envio correctamente');
  }
  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show(Request $request)
  {
    return view("forms.ticket");
return ("desde show");
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
  public function estado(Request $request, $id)
  {
    $cot = SolicitudAnulacion::findOrFail($id);
    $cot->estado = $request->estado;
    $cot->save();
    return redirect()->route('solicitudanuladas.create',)->with('success', 'El formulario se envio correctamente');
  }
  
  public function estadoTicket(Request $request, $id)
  {
    $cot = SolicitudAnulacion::findOrFail($id);
    $cot->estado = $request->estado;
    $cot->save();
    return redirect()->route('solicitudanuladas.create',)->with('success', 'El formulario se envio correctamente');
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
