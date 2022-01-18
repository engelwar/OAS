<?php

namespace App\Http\Controllers;

use App\Models\Computadora;
use App\Models\Componente;
use Illuminate\Http\Request;

/**
 * Class ComputadoraController
 * @package App\Http\Controllers
 */
class ComputadoraController extends Controller
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
    $computadoras = Computadora::paginate();

    return view('computadora.index', compact('computadoras'))
      ->with('i', (request()->input('page', 1) - 1) * $computadoras->perPage());
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $computadora = new Computadora();
    return view('computadora.create', compact('computadora'));
  }

  public function creates($id_empleado)
  {
    echo $id_empleado;
    $computadora = new Computadora();
    return view('computadora.create', compact('computadora', 'id_empleado'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    request()->validate(Computadora::$rules);
    echo $request;

    // $computadora = Computadora::create([
    //   'tipo' => $request->tipo,
    //   'ip' => $request->ip,
    //   'estado' => $request->funcional,
    //   'id_empleado' => $request->id_empleado,
    // ]);
    // $idcpu = Computadora::latest('id')->first();
    // if ($request['marca'][0] != null) {
    //   foreach ($request->marca as $i => $j) {
    //     Componente::create(['marca' => $request['marca2'][$i], 'tipo' => $request['tipo2'][$i], 'modelo' => $request['modelo2'][$i], 'ns' => $request['ns2'][$i], 'caracteristicas' => $request['caracteristicas2'][$i], 'estado' => $request['estado2'][$i], 'id_compu' => $request[$idcpu]]);
    //   }
    // }
    // $computadora = Computadora::create($request->all());

    return redirect()->route('empleados')
      ->with('success', 'Computadora created successfully.');
  }

  /**
   * Display the specified resource.
   *
   * @param  int $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $computadora = Computadora::find($id);

    return view('computadora.show', compact('computadora'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $computadora = Computadora::find($id);

    return view('computadora.edit', compact('computadora'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request $request
   * @param  Computadora $computadora
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Computadora $computadora)
  {
    request()->validate(Computadora::$rules);

    $computadora->update($request->all());

    return redirect()->route('computadoras.index')
      ->with('success', 'Computadora updated successfully');
  }

  /**
   * @param int $id
   * @return \Illuminate\Http\RedirectResponse
   * @throws \Exception
   */
  public function destroy($id)
  {
    $computadora = Computadora::find($id)->delete();

    return redirect()->route('computadoras.index')
      ->with('success', 'Computadora deleted successfully');
  }
}
