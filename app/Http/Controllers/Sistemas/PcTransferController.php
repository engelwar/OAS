<?php

namespace App\Http\Controllers;
use App\InventarioPc;
use App\Perfil;
use Illuminate\Http\Request;

class PcTransferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pc=InventarioPc::all();
        $perfiles = Perfil::all();

        //return dd($pcs);
        return view('inventariopc.transfer.index', compact('pc', 'perfiles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $pc=InventarioPc::find($id);
        $perfiles = Perfil::all();
        //return dd($pcs);
        return view('inventariopc.transfer.edit', compact('pc', 'perfiles'));
    }
    public function quitar($id)
    {
        $pc=InventarioPc::find($id);
        return dd($pc->funcionario);
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
}
