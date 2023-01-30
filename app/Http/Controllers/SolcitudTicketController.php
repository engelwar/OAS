<?php

namespace App\Http\Controllers;

use App\SolcitudTicket;
use Illuminate\Http\Request;

class SolcitudTicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("forms.ticket");
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
     * @param  \App\SolcitudTicket  $solcitudTicket
     * @return \Illuminate\Http\Response
     */
    public function show(SolcitudTicket $solcitudTicket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SolcitudTicket  $solcitudTicket
     * @return \Illuminate\Http\Response
     */
    public function edit(SolcitudTicket $solcitudTicket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SolcitudTicket  $solcitudTicket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SolcitudTicket $solcitudTicket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SolcitudTicket  $solcitudTicket
     * @return \Illuminate\Http\Response
     */
    public function destroy(SolcitudTicket $solcitudTicket)
    {
        //
    }
}
