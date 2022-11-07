<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carta</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        body{
            font-size:0.8rem;
        }
        .raya {
border-bottom: 1px solid #000000;
}

.contenedor-imagenes {
  display: flex;
padding-left: 170px;
}
.separador{
    padding-left: 30px;
}
.contenedor-imagenes img:first-child {
  margin-right: 50px;

}
    </style>
</head>
<body>

        
    
    
    
    @foreach ($arraycxcCarta as $key=> $v)
        
        <h5>La Paz {{$fechaH}}</h5>       
        <h5>LYPO/ADM//COB/[001-2022]</h5>
            <H3 class="mt-5">Señor Cliente</H3>
            <H3>{{$key}}</H3>
 
            <H3>Presente.-</H3>
            <H3 style="text-align: right"><strong> Ref.: <span class="raya">CONFIRMACION DE SALDO CLIENTES</strong> </span> </H3>
        
            <H3 class="mt-5">Distinguidos cliente:</H3>
            <br>
            @if($v)
      
            @foreach($v as $h => $i)
        
            <p style="padding-top: 20px;text-indent: 25px;font-size: 15px"> Como resultado de la Auditoria Interna realizada al {{$fechaC}}, nuestros libros contables regisdtran un saldo por cobrar de $us. {{$i->ImporteCXCDolar}} (literal)
                 ,su equivalente al tipo de cambio actual de BS. {{$i->ImporteCXCBS}}  detallado de la siguiente manera:
                </p>  
                @endforeach   
           @endif       
  <h4 style="text-align: center; padding-top: 20px;"> <strong>ESTADO DE CUENTA CLIENTE</strong></h4>
  <h4 style="text-align: center;"> <strong>Al: {{$fechaC}}</strong></h4>
    <table class = "table table-bordered table-sm">
        <thead class="thead-light">
            <tr>
                <td colspan="3" style="text-align: center;background: #d8d8e4;">FECHA</td>
                <td style="background: #c8c8ea;"></td>
                <td colspan="3"  style="border-inline-color: initial   text-align: center;background: #c8c8ea;">IMPORTE EN DOLARES</td>
                <td colspan="3" style="text-align: center;background: #d8d8e4;">IMPORTE EN BOLIVIANOS</td>
            </tr>
            <tr>
           
            <td style="text-align: center;background: #d8d8e4;">FACTURADO</td>
            <TD style="text-align: center;background: #d8d8e4;">NRO. FACTURA</TD>
            <td style="text-align: center;background: #d8d8e4;">VENCIMIENTO</td>
            <td style="text-align: center;background: #c8c8ea;">ESTADO</td>
            <td style="text-align: center;background: #c8c8ea;">IMPORTE</td>
            <td style="text-align: center;background: #c8c8ea;">A CUENTA</td>
            <td style="text-align: center;background: #c8c8ea;">SALDO</td>
            <td style="text-align: center;background: #d8d8e4;">IMPORTE</td>
            <td style="text-align: center;background: #d8d8e4;">A CUENTA</td>
            <td style="text-align: center;background: #d8d8e4;">SALDO</td>
            </tr>
        </thead>

        <tbody>
            @if($v)
      
            @foreach($v as $h => $i)
            <tr>
                <td style="text-align: center" >{{$i->Fecha}}</td>
                <td style="text-align: center" >{{$i->NroFac}}</td>
                <td style="text-align: center" >{{$i->FechaVenc}}</td>
                <td style="text-align: center" >{{$i->estado}}</td>
                <td style="text-align: center" >{{$i->ImporteCXCDolar}}</td>
                <td style="text-align: center" >{{$i->ACuentaDolar}}</td>
                <td style="text-align: center" >{{$i->SaldoDolar}}</td>
                <td style="text-align: center" >{{$i->ImporteCXCBS}}</td>
                <td style="text-align: center" >{{$i->ACuentaBS}}</td>
                <td style="text-align: center" >{{$i->SaldoBS}}</td>
            </tr>
             @endforeach
            @endif

           @foreach ($totalS[$key] as $y => $t) 
           <tr>
            <td style="text-align: center;border: none;" colspan="3"></td>
            
            <td style="text-align: center" >TOTALES</td>
            <td style="text-align: center" >{{$t->ImporteCXCDolar}}</td>
            <td style="text-align: center" >{{$t->ACuentaDolar}}</td>
            <td style="text-align: center" >{{$t->SaldoDolar}}</td>
            <td style="text-align: center" >{{$t->ImporteCXCBS}}</td>
            <td style="text-align: center" >{{$t->ACuentaBS}}</td>
            <td style="text-align: center" >{{$t->SaldoBS}}</td>
           
        </tr>
           @endforeach

        </tbody>
        </tfoot>
        
    </table>
   <p style="padding-top: 20px;text-indent: 25px;font-size: 15px">Agradecemos comunicar cualquier observación, adjuntando el debido respaldo, caso contrario daremos por confimado el saldo mencionado.</p>
   
   <p style="padding-top: 20px;text-indent: 25px;font-size: 15px">Por lo tanto, corresponde de su parte la debida atención a nuestro requerimiento. Sin otro particular, enviamos un cordial saludo.</p>
   

  
  
   <div class="contenedor-imagenes">
   <img alt="foto" src="{{asset('imagenes/firma/fdemo.png')}}" style="width: 30%; "/>   

        <img alt="foto" src="{{asset('imagenes/firma/fdemo.png')}}" style="width: 30%; "/>   
     
      </div>

    @endforeach
  

   
  
   

     
  
 


   
</body>


</html>

