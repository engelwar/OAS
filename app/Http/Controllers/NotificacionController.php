<?php

namespace App\Http\Controllers;

use App\Notificacion;
use Illuminate\Http\Request;
use App\LicenciaForm;

class NotificacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('notifications.index',[
    		'unreadNotifications'=> auth()->user()->unreadNotifications,
    		'readNotifications'=> auth()->user()->readNotifications
    	]);
    
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
        return dd("datos");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Notificacion  $notificacion
     * @return \Illuminate\Http\Response
     */
    public function show(Notificacion $notificacion, LicenciaForm $LicenciaForm )
    {
        
        $var =10;
        $LicenciaForm2=LicenciaForm::all();

        
        return view('layouts.sidebar', compact('LicenciaForm2', 'var'));
        return dd($LicenciaForm2);         

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Notificacion  $notificacion
     * @return \Illuminate\Http\Response
     */
    public function edit(Notificacion $notificacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Notificacion  $notificacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Notificacion $notificacion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Notificacion  $notificacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notificacion $notificacion)
    {
        //
    }
    public function read($id)
    {
        $notification = auth()->user()->notifications()->where('id', $id)->first();
        $notification->delete();
    	return redirect()->back()->with('flash','Notificacion marcada como leida');
    }
    public function deleteall()
    {
        $notifications = auth()->user()->unreadnotifications()->delete();
    	return redirect()->back()->with('flash','Notificacion marcada como leida');
    }
    public function redirect($url, $id)
    {
        return redirect()->route($url,$id)->with('success','El formulario se envio correctamente');
    }
}
