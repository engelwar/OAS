<?php

namespace App\Http\Controllers\Inventarios;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User; 
use App\TomInvUbic;
use App\TomInvTom;
use App\TomInvCont;
use DataTables;
use DB;
class TomInvConfigController extends Controller
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
        $users = User::get();
        return view('inventarios.tominvconfig', compact('users'));
    }

    public function getTom(Request $request)
    {
        $tom = TomInvTom::with(['Sucs', 'Funcionarios', 'Conts'])->get();
        return DataTables::of($tom)->make(); 
    }
    public function getCont(Request $request)
    {
        if($request->tom_id){
            $cont = TomInvCont::where('tom_inv_tom_id',$request->tom_id )->with(['Funcionarios', 'Toma'])->get();
        }
        else{
            $cont = TomInvCont::with(['Funcionarios', 'Toma'])->get();
        }
        return DataTables::of($cont)->make(); 
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getSucs(Request $request)
    {
        $sucs = TomInvTom::select('suc_id', DB::raw('count(id) as canttomas'))->with('Sucs')->groupBy('suc_id')->get();
        //return dd($sucs);
        return DataTables::of($sucs)->make(); 
    }
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nro' => ['required', 'integer'],
            'nombre' =>['required', 'string', 'max:255'],
            'suc_id'=>['required', 'integer'],
        ]);  
        $ubic = TomInvUbic::create($validated);
        return response()->json($ubic);
    }
    public function storeTom(Request $request)
    {
        $vato = $request->validate([
            //'suc_id'=>['required', 'integer'],
            'suc_id'=>['required', 'integer'],
            'ubi'=>['required', 'string', 'max:255'],
            'user_id'=>['required', 'integer'],
            'fini'=>['required', 'date']
        ]);  
        $tom = TomInvTom::where(
            $vato
        )->get(); 
        if(count($tom) == 0){    
            $tom = TomInvTom::create(          
                $vato
            ); 
            $cont = TomInvCont::create([
                'conteo_id'=>1,
                'user_id'=>$request->user_id,
                'estado'=>0,
                'tom_inv_tom_id'=>$tom->id,
                'hoja'=>1
            ]);
            $cont = TomInvCont::create([
                'conteo_id'=>2,
                'user_id'=>$request->user_id,
                'estado'=>0,
                'tom_inv_tom_id'=>$tom->id,
                'hoja'=>1
            ]);
            $cont = TomInvCont::create([
                'conteo_id'=>3,
                'user_id'=>$request->user_id,
                'estado'=>0,
                'tom_inv_tom_id'=>$tom->id,
                'hoja'=>1
            ]);
        }
        return response()->json($tom);
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
    public function destroy_ubic(Request $request)
    {
        $ubic = TomInvUbic::find($request->id);
        if($ubic->Tomas)
        {
            return response()->json(['error'=>'No se puede eliminar, tiene conteos asociados']);
        }
        else{
            $ubic->delete();
            return response()->json(['success'=>'Se elimino correctamente']);
        }
    }
}
