<?php

namespace App\Http\Controllers\Sistemas;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use App\InventarioPc;
use App\InventarioDispositivo;
use App\PcRemoto;
use App\Perfil;
use App\Area;
use PDF;


class InventarioSistemasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pcs=InventarioPc::orderBy('ubicacion', 'ASC')
        ->orderBy('nombre','ASC')        
        ->paginate(500);
        //return dd($pcs);
        return view('sistemas.inventario.pc.index', compact('pcs'));     
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($cont)
    {
        return view('sistemas.inventario.pc.create', compact('cont'));
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
        $pc = InventarioPc::create([          
            'area'=>$request->area,   
            'ip'=>$request->ip,  
            'funcionario'=>$request->funcionario,  
            'ci'=>$request->ci,  
            'estado'=>$request->estado, 
            'ubicacion'=>$request->ubicacion,  
            'observaciones'=>$request->observaciones,  
            'nombre'=>$request->nombre            
        ]);
        /*for ($i=1; $i <= $request->cont; $i++) { 
            $tipo='tipo'.$i;
            $tipo=$request->$tipo; 
            $num_serie='num_serie'.$i;
            $num_serie=$request->$num_serie;  
            $marca='marca'.$i;
            $marca=$request->$marca;  
            $modelo='modelo'.$i;
            $modelo=$request->$modelo;  
            $caracteristicas='caracteristicas'.$i;
            $caracteristicas=$request->$caracteristicas;
            $estado='estado'.$i;
            $estado=$request->$estado;
            echo ("ant".$i);
            if($tipo!=null || $num_serie!=null || $marca!=null || $modelo!=null || $caracteristicas!=null || $estado!=null)
            {
                $dispositivo= InventarioDispositivo::create([
                'tipo'=>$tipo,
                'num_serie'=>$num_serie,
                'marca'=>$marca,
                'modelo'=>$modelo,
                'caracteristicas'=>$caracteristicas,
                'pc_id'=>$pc->id,
                'estado'=>$estado
                ]);
                //$form->gastos()->save($gastos); 
            }    
        }*/
        //return dd($request);
        return redirect()->route('inventariosistemas.index')->with('success','El formulario se envio correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
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
        $perfiles = Perfil::orderBy('nombre', 'ASC')->get();
        $areas = Area::orderBy('nombre', 'ASC')->get();
        $disp = $pc->dispositivo()->get();
        if($pc->dispositivo()->where('tipo', 'CPU')->first())
        {
            $cpu = $pc->dispositivo()->where('tipo', 'CPU')->first()->caracteristicas;
        }
        else
        {
            $cpu = "N/A";
        }
        if($pc->dispositivo()->where('tipo', 'RAM')->first())
        {
            $ram = $pc->dispositivo()->where('tipo', 'RAM')->first()->caracteristicas;
        }
        else{
            $ram="N/A";
        }
        $qr="ID: ". $pc->id.
        "\nCPU: ". $cpu . 
        "\nRAM: ". $ram;
        return view('sistemas.inventario.pc.edit', compact('disp', 'pc', 'qr', 'perfiles', 'areas'));
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
        $user = Auth::user();
        $pc = InventarioPc::find($id);
        $pc->update([          
            'area'=>$request->area,   
            'ip'=>$request->ip,  
            'funcionario'=>$request->funcionario,  
            'ci'=>$request->ci,  
            'estado'=>$request->estado, 
            'ubicacion'=>$request->ubicacion,  
            'observaciones'=>$request->observaciones,   
            'nombre'=>$request->nombre,  
            'perfil_id'=>$request->perfil_id, 
            'tipo'=>$request->tipo,       
        ]);    
        //$disp = $pc->dispositivo;   
        /*foreach ($disp as $d) {
            if(
                $d->tipo !== $request->a_tipo[$d->id]  ||
                $d->marca !== $request->a_marca[$d->id] || 
                $d->modelo !== $request->a_modelo[$d->id] || 
                $d->num_serie !== $request->a_num_serie[$d->id] || 
                $d->caracteristicas !== $request->a_caracteristicas[$d->id] || 
                $d->estado !== $request->a_estado[$d->id])
            {
                //echo("cambiar </br>");
                InventarioDispositivo::find($d->id);
                $d->update([
                    'tipo'=>$request->a_tipo[$d->id],
                    'num_serie'=>$request->a_num_serie[$d->id],
                    'marca'=>$request->a_marca[$d->id],
                    'modelo'=>$request->a_modelo[$d->id],
                    'caracteristicas'=>$request->a_caracteristicas[$d->id],
                    'estado'=>$request->a_estado[$d->id],
                ]);
            }
        }*/  
        /*for ($i=0; $i < $request->cont; $i++)
        {
            $tipo=$request->tipo[$i]; 
            $num_serie=$request->num_serie[$i];
            $marca=$request->marca[$i];
            $modelo=$request->modelo[$i];
            $caracteristicas=$request->caracteristicas[$i];
            $estado=$request->estado_n[$i];
            if($tipo!=null || $num_serie!=null || $marca!=null || $modelo!=null || $caracteristicas!=null || $estado!=null)
            {
                $dispositivo= InventarioDispositivo::create([
                'tipo'=>$tipo,
                'num_serie'=>$num_serie,
                'marca'=>$marca,
                'modelo'=>$modelo,
                'caracteristicas'=>$caracteristicas,
                'pc_id'=>$pc->id,
                'estado'=>$estado
                ]);
                //$form->gastos()->save($gastos); 
            }
        }*/
        return redirect()->route('inventariosistemas.index')->with('success','El formulario se envio correctamente');
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
    public function pdf(Request $request)
    {
        $form = InventarioPc::all();
          $pdf = \PDF::loadView('sistemas.inventario.pc.pdf', compact('form'))
          ->setPaper('letter');   
          return $pdf->stream('github.pdf');
    }
    public function pdfqr(Request $request)
    {
        $form = InventarioPc::all();  
        //return storage_path("fonts/light.ttf");
        //$form->put('test','test');
        foreach ($form as $pc) {
            if($pc->dispositivo()->where('tipo', 'CPU')->first())
            {
                $cpu = $pc->dispositivo()->where('tipo', 'CPU')->first()->caracteristicas;
            }
            else
            {
                $cpu = "N/A";
            }
            if($pc->dispositivo()->where('tipo', 'RAM')->first())
            {
                $ram = $pc->dispositivo()->where('tipo', 'RAM')->first()->caracteristicas;
            }
            else{
                $ram="N/A";
            }
            $qr="ID: ". $pc->id.
            "\nCPU: ". $cpu . 
            "\nRAM: ". $ram;
            $pc->setAttribute('qr', $qr);
        }
        $fo = $form->find(12);
        $form = $form->chunk(4);        
        $monitor = InventarioDispositivo::where('tipo', 'Monitor')->get();

        foreach ($monitor as $m) 
        {
            $qr="ID: ". $m->id.
            "\nMarca: ". $m->marca . 
            "\nModelo: ". $m->modelo .
            "\nDescrip". $m->caracteristicas;

            $m->setAttribute('qr', $qr);
        }
        $monitor = $monitor->chunk(7);
        $mouse = InventarioDispositivo::where('tipo', 'Mouse')->get();

        foreach ($mouse as $mou) 
        {
            $qr="ID: ". $mou->id;

            $mou->setAttribute('qr', $qr);
        }
        $mouse = $mouse->chunk(8);
        $teclado = InventarioDispositivo::where('tipo', 'Teclado')->get();

        foreach ($teclado as $te) 
        {
            $qr="ID: ". $te->id;
            $te->setAttribute('qr', $qr);
        }
        $teclado = $teclado->chunk(8);
        $imp_ter = InventarioDispositivo::where('tipo', 'Impresora')->get();

        foreach ($imp_ter as $imp) 
        {
            $qr="ID: ". $imp->id .
            "\nMarca: ". $imp->marca .
            "\nModelo: " . $imp->modelo;
            $imp->setAttribute('qr', $qr);
        }
        $imp_ter = $imp_ter->chunk(8);
        $pdf = \PDF::setPaper('letter')->loadView('sistemas.inventario.pc.pdfqr', compact('fo','form', 'monitor', 'mouse', 'teclado', 'imp_ter'));
        return $pdf->stream('archivo.pdf');
    }
}
