<?php

namespace App\Http\Controllers\Sistemas;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use App\InventarioDispositivo;

class InventarioDispositivosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipos = InventarioDispositivo::
        select('tipo')->groupBy('tipo')
        ->get();
        //return dd($tipos[0]->tipo);
        $disp=InventarioDispositivo::orderBy('id','DESC')
        ->get();
        return view('sistemas.inventario.dispositivo.index',compact('disp','tipos'));  
    }
    public function pagina()
    {
        $posts = Post::paginate(3);
        $response = [
           'pagination' => [
               'total' => $posts->total(),
               'per_page' => $posts->perPage(),
               'current_page' => $posts->currentPage(),
               'last_page' => $posts->lastPage(),
               'from' => $posts->firstItem(),
               'to' => $posts->lastItem()
           ],
           'data' => $posts
        ];
        return response()->json($response);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('inventariosistemas.dispositivo');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $pc = InventarioDispositivo::create([          
            'marca'=>$request->marca,   
            'modelo'=>$request->modelo,  
            'num_serie'=>$request->num_serie,  
            'tipo'=>$request->tipo,  
            'estado'=>$request->estado, 
            'caracteristicas'=>$request->caracteristicas,    
        ]);    
    
        return redirect()->route('inventariodispositivos.index')->with('success','El formulario se envio correctamente');
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
        $disp=InventarioDispositivo::find($id);

        $qr="ID: ". $disp->id."\nTipo: ". $disp->tipo 
        ."\nMarca: ".$disp->marca."\nModelo: ". $disp->modelo;
        return view('sistemas.inventario.dispositivo.edit', compact('disp', 'qr'));
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
        $disp = InventarioDispositivo::find($id);
        $disp->update($request->all());
        return redirect()->route('dispositivos.index', $disp->id);
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
