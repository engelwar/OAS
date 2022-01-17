<?php

namespace App\Http\Controllers\Configuracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Perfil;
use App\Permiso;
use Illuminate\Support\Facades\Storage;
use App\Unidad;

class PerfilController extends Controller
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
        if(Auth::user()->authorizePermisos(['Funcionarios', 'Ver']))
        {
            $user = Auth::user();
            $perfil=Perfil::orderBy('id','DESC')
            ->get();
            return view('configuracion.perfiles.index',compact('perfil'));      
        }
        else
        {
            return dd('largo de aqui');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        return view("configuracion.perfiles.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->file('foto'))
        {
            $path = $request->file('foto')->store('images');
        }
        else{
            $path = NULL;            
        } 
        $data = $request->validate([
            'nombre' => 'required|max:255',
            'paterno' => 'required',
            'materno' => 'nullable',
            'fecha_nac' => 'nullable',
            'ci' => 'nullable|unique:perfils',
            'ci_e' => 'nullable',
            'unidad_id' => 'required',
            'cargo' => 'nullable',
            'corp_telf' => 'nullable',
            'corp_int' => 'nullable',
            'corp_email' => 'nullable|unique:perfils',
            'area_id' => 'nullable',
            'corp_celu' => 'nullable',
            'fecha_ingreso' => 'nullable',
            'dias_vacacion' => 'nullable',
            'telf' => 'nullable',
            'direc' => 'nullable',
            'celu' => 'nullable',
            'email' => 'nullable|unique:perfils',   
        ]);
        $perfil = Perfil::create(          
            $data += ['foto'=>$path]
        );      
        return redirect()->route('perfil.index');
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
        $user = Auth::user();
        if($user->authorizePermisos(['Usuarios','Ver']))
        {
            $perfil=Perfil::find($id);
            return view('configuracion.perfiles.edit',compact('perfil'));
        }
        else
        {
            return dd('largo de aqui');
        }
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
        $perfil = Perfil::find($id);   
        $data = $request->validate([
            'nombre' => 'required|max:255',
            'paterno' => 'required',
            'materno' => 'required',
            'fecha_nac' => 'nullable',
            'ci' => 'required|unique:perfils,ci,'.$id,
            'ci_e' => 'required',
            'cargo' => 'nullable',
            'corp_telf' => 'nullable',
            'corp_int' => 'nullable',
            'corp_email' => 'nullable|unique:perfils,corp_email,'.$id,
            'area_id' => 'required',
            'corp_celu' => 'nullable',
            'fecha_ingreso' => 'nullable',
            'dias_vacacion' => 'nullable',
            'telf' => 'nullable',
            'direc' => 'nullable',
            'celu' => 'nullable',
            'unidad_id'=>'required',
            'email' => 'nullable|unique:perfils,email,'.$id,   
        ]);            
        if($request->check_f == 'true')
        {  
            Storage::delete($perfil->foto);              
            $path = $request->file('foto')->store('images');
            $perfil->foto = $path;
            $perfil->save();
        }
        elseif($request->check_f == 'false')
        {
            Storage::delete($perfil->foto);
            $perfil->foto = NULL;
            $perfil->save();
        }
        $perfil->update($request->except(['foto']));
        return redirect()->route('perfil.index');
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
