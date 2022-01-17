<?php

namespace App\Http\Controllers\Sistemas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\SisInvTdp;
use DataTables; 

class SisInvController extends Controller
{
    public function index(){
       $tipo = SisInvTdp::all();
       return view('sistemas.inventario.config.index', compact('tipo'));
    }
    public function list(){
        $tipo = SisInvTdp::all();
        return Datatables::of($tipo)->make();
    }

    public function store(Request $request){
        $tipo = SisInvTdp::create(
            $request->all()
        );
       return response()->json($tipo);
    }
    public function destroy(Request $request){
        $tipo = SisInvTdp::find($request->id)->delete();
        $tipo = SisInvTdp::all();
        return response()->json($tipo);
    }
}
