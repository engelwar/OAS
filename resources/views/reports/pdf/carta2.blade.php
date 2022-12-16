<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carta</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>


img.redimension {
  padding-top: 1px;
  position: absolute;

  margin: 0px;
  padding-left: 35px;
    width:890px;
  height:auto;
  color: #000000;
}
        #imagen{
            font-family: Arial;
margin: 35px;
margin-bottom: 10px;
width: 500px;
padding-top: -100px;
padding: 0;
border-width: 0; 

        }
      #margen     {
        font-family: Arial;
margin: 45px;
margin-bottom: 2px;
padding: 0;
border-width: 0;
padding-top: 10px;
}
#margenBottom  {
        font-family: Arial;
margin: 50px;
margin-bottom: 0px;
margin-top: 0px;
padding: 0;
border-width: 0;
}
.text-justify {
  text-align: justify;
  text-indent: 60px;
  font-size: 17px;
}
        body{
            font-size:0.8rem;
            font-family: Arial;
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
.letra{
    font-family: Arial;
}
.imagenT1{
    padding-top: 70px;
}
.imagenT2{
    padding-top: 70px;
    padding-right: 50px;
}
    </style>
</head>
<body>

        
    
    
   
<div id="margen">
    <h5 class="letra">La Paz {{$fechaH}}</h5>       
    <h5 class="letra">LYPO/ADM//COB/[0{{$conta}} - 2022]</h5>
        <H3 class="letra; mt-5">{{$option}}</H3>
        <H3 class="letra">{{$clienteC}}</H3>

        <H3 class="letra">Presente.-</H3>
        <H3 style="text-align: right" class="letra"><strong> Ref.: <span class="raya;letra">CONFIRMACION DE SALDO CLIENTES</strong> </span> </H3>
        @if ($option=="Señor")
        <span class="letra;mt-5" style="font-size: 18px;">Distinguido {{$option}}:</span>  
        @endif
        @if ($option=="Señora")
        <span class="letra;mt-5" style="font-size: 18px;">Distinguida {{$option}}:</span>  
        @endif
        @if ($option=="Señores")
        <span class="letra;mt-5" style="font-size: 18px;">Distinguidos {{$option}}:</span>  
        @endif
        <p style="padding-top: 20px;" class="text-justify"> Como resultado de la Auditoria Interna realizada al {{$fechaC}}, nuestros libros contables registran un saldo por cobrar de $us. {{$dolar}} ({{$dolarNu[0]}} {{$dolarNu[1]}} Dolares), 
            su equivalente al tipo de cambio actual de Bs. {{$bs}} ({{$bsNu[0]}} {{$bsNu[1]}} Bolivianos), detallado de la siguiente manera:
       </p> 
     
</div>
<h4 style="text-align: center; padding-top: 4px;"> <strong class="letra">ESTADO DE CUENTA CLIENTE</strong></h4>
       <h4 style="text-align: center; font-size: 12px"> <strong class="letra" >Al: {{$fechaC}}</strong></h4>
    <div style="padding-top: 10px">
        <table class = "table table-bordered table-sm" > 
            <thead class="thead-light">
          <tr>
              <td colspan="3" style="text-align: center;background: #d8d8e4; font-size: 17px" class="letra">FECHA</td>
              <td style="background: #c8c8ea;"></td>
              <td colspan="3"  style="border-inline-color: initial   text-align: center;background: #c8c8ea; font-size: 17px" class="letra">IMPORTE EN DOLARES</td>
              <td colspan="3" style="text-align: center;background: #d8d8e4; font-size: 17px" class="letra">IMPORTE EN BOLIVIANOS</td>
          </tr>
          <tr>
     
              <td style="text-align: center;background: #d8d8e4;" class="letra">FACTURADO</td>
              <TD style="text-align: center;background: #d8d8e4;" class="letra">NRO. FACTURA</TD>
              <td style="text-align: center;background: #d8d8e4;" class="letra">VENCIMIENTO</td>
              <td style="text-align: center;background: #c8c8ea;" class="letra">ESTADO</td>
              <td style="text-align: center;background: #c8c8ea;" class="letra">IMPORTE</td>
              <td style="text-align: center;background: #c8c8ea;" class="letra">A CUENTA</td>
              <td style="text-align: center;background: #c8c8ea;" class="letra" >SALDO</td>
              <td style="text-align: center;background: #d8d8e4;" class="letra">IMPORTE</td>
              <td style="text-align: center;background: #d8d8e4;" class="letra">A CUENTA</td>
              <td style="text-align: center;background: #d8d8e4;" class="letra">SALDO</td>
              </tr>
          </thead>
          <tbody>
              @foreach ($cxcCarta as $i)
              <tr>
                  <td style="text-align: center" class="letra">{{$i->Fecha}}</td>
                  <td style="text-align: center" class="letra">{{$i->NroFac}}</td>
                  <td style="text-align: center" class="letra">{{$i->FechaVenc}}</td>
                  <td style="text-align: center" class="letra">{{$i->estado}}</td>
                  <td style="text-align: center" class="letra">{{$i->ImporteCXCDolar}}</td>
                  <td style="text-align: center" class="letra">{{$i->ACuentaDolar}}</td>
                  <td style="text-align: center" class="letra">{{$i->SaldoDolar}}</td>
                  <td style="text-align: center" class="letra">{{$i->ImporteCXCBS}}</td>
                  <td style="text-align: center" class="letra">{{$i->ACuentaBS}}</td>
                  <td style="text-align: center" class="letra">{{$i->SaldoBS}}</td>
              </tr>
              @endforeach
              @foreach ($totalS as $t)
              <tr>
                  <td style="text-align: center;border: none;" colspan="3"></td>
                  
                  <td style="text-align: center;" class="letra">TOTALES</td>
                  <td style="text-align: center" class="letra">{{$t->ImporteCXCDolar}}</td>
                  <td style="text-align: center" class="letra">{{$t->ACuentaDolar}}</td>
                  <td style="text-align: center" class="letra">{{$t->SaldoDolar}}</td>
                  <td style="text-align: center" class="letra">{{$t->ImporteCXCBS}}</td>
                  <td style="text-align: center" class="letra">{{$t->ACuentaBS}}</td>
                  <td style="text-align: center" class="letra">{{$t->SaldoBS}}</td>
                 
              </tr>  
              @endforeach
              
          </tbody>
  </table>
    </div>     
   
    <div id="margenBottom" >
        <p style="padding-top: 0px;font-size: 17px"class="text-justify" >Agradecemos comunicar cualquier observación, adjuntando el debido respaldo, caso contrario daremos por confimado el saldo mencionado.</p>
       
    </div>
  


 
   <div style="position: absolute">

   <img style="position: relative;" alt="foto" class="redimension" src="{{asset('imagenes/IMAGEN1.png')}}"/> 
    </div>
    </body> 
    </html>