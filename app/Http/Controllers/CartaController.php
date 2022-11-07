<?php

namespace App\Http\Controllers;

use App\Carta;
use Illuminate\Http\Request;

class CartaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // return "desde index";
        return view('carta.Carta');
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
     * @param  \App\Carta  $carta
     * @return \Illuminate\Http\Response
     */
    public function show(Carta $carta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Carta  $carta
     * @return \Illuminate\Http\Response
     */
    public function edit(Carta $carta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Carta  $carta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Carta $carta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Carta  $carta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Carta $carta)
    {
        //
    }
}
