<?php

namespace App\Http\Controllers\Sistemas;
use App\Http\Controllers\Controller;
use Auth;
use App\InventarioCelular;
use Illuminate\Http\Request;

class InventarioCelularController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cel=InventarioCelular::orderBy('id','DESC')
        ->paginate(10);
        return view('inventariosistemascelulares',compact('cel'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('inventariosistemas.celulares');
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
        $pc = InventarioCelular::create([          
            'imei'=>$request->imei,
            'num_serie'=>$request->num_serie,
            'marca'=>$request->marca,
            'modelo'=>$request->modelo,
            'nombre_comercial'=>$request->nombre_comercial,
            'color'=>$request->color,
            'pantalla'=>$request->pantalla,
            'rom'=>$request->rom,
            'cpu'=>$request->cpu,
            'ram'=>$request->ram,
            'camara_principal'=>$request->camara_principal,
            'camara_frontal'=>$request->camara_frontal,
            'so'=>$request->so,
            'bateria'=>$request->bateria,
            'sd'=>$request->sd,
            'cargador'=>$request->cargador,
            'cable_usb'=>$request->cable_usb,
            'audifonos'=>$request->audifonos,
    

        ]);    
    
        return redirect()->route('inventariocelular.index')->with('success','El formulario se envio correctamente');
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
        $cel=InventarioCelular::find($id);
        return view('detalle.celulares', compact('cel'));
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
        //return dd($request);
        $cel = InventarioCelular::find($id);
        $cel->update($request->all());
        return redirect()->route('inventariocelular.edit', $cel->id);
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
