<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte Cotizacion </title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        body{
            font-size:0.8rem;
        }
    </style>
</head>
<body>
   
    <table style="width:100%">
        <tr valign= "middle"> 
            <td style="width: 20%;">
                <img alt="foto" src="{{asset('imagenes/logo.png')}}" style="width: 100%;
                height: auto;"/>      
            </td>
            <td style="width: 60%; text-align: center;">
                <h4>REPORTE DE COTIZACION</h4>       
           
                             
            </td>
            <td style="width: 20%; text-align: right;">                
            </td>
        </tr>                       
    </table>
    <H3 class="mt-5">Reporte de Cotizacion</H3>
    <table class = "table table-bordered table-sm">
        <thead class="thead-light">

            <tr>
                <th>Fecha Cotizacion</th>
                <th>Nro Cotizacion</th>
                <th style="text-align: center">Cliente</th>
                <th>Fecha NR</th>
                <th>Nota de remision</th>
                <th>Total ventas</th>
                <th>Moneda</th>
                <th>Usuario vendedor</th>
                <th>Local</th>
                <th>Fecha facturacion</th>
                <th>Nro facturacion</th>
                <th>Estado</th>
                <th>Observacion</th>
            </tr>
        </thead>
        <tbody>
                        
                @foreach ($consultas as $item)
                                   
               <tr>
                    <td style="text-align:center" class="bold">{{$item->Fecha}}</td> 
                    @if(strval($item->NroCotizacion)==="0")
                    <td style="text-align:center" class="bold">-</td>
                    @else
                    <td style="text-align:center" class="bold">{{$item->NroCotizacion}}</td> 
                    @endif                   
                    
                    <td style="text-align:center" class="bold">{{$item->Cliente}}</td>
                    <td style="text-align:center" class="bold">{{$item->FechaNR}}</td>
                    <td style="text-align:center" class="bold">{{$item->NR}}</td>
                    <td style="text-align:center" class="bold">{{$item->Totalventas}}</td>
                    <td style="text-align:center" class="bold">{{$item->Moneda}}</td>
                    <td style="text-align:center" class="bold">{{$item->Usuario}}</td>
                    <td style="text-align:center" class="bold">{{$item->Local}}</td>
                    @if (is_null($item->FechaFac))
                    <td style="text-align:center" class="bold" >-</td>
                    @else
                    <td style="text-align:center" class="bold">{{$item->FechaFac}}</td>
                    @endif
                                        
                    @if (is_null($item->numerofactura))
                    <td style="text-align:center" class="bold" >-</td>
                    @else
                    <td style="text-align:center" class="bold">{{$item->numerofactura}}</td> 
                    @endif
                    
                    
                    @if (is_null($item->estado))
                    <td style="text-align:center" class="bold" >-</td>
                    @else
                    <td style="text-align:center" class="bold">{{$item->estado}}</td> 
                    @endif
                   
                    <td style="text-align:center" class="bold">es una observacion</td>
                </tr>
            
                @endforeach            
        </tbody>
    </table>
   
   
</body>
</html>

