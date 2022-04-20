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
                <b>Vendedor:</b> will smith 
                <p><b>Fecha:</b> fecha</p>                 
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
                <th>Cliente</th>
                <th>Fecha NR</th>
                <th>Notas de remision</th>
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
       
                <tr>
                    <td style="text-align:center" class="bold">02/02/22</td>                    
                    <td style="text-align:center" class="bold">000001</td>
                    <td style="text-align:center" class="bold">will smith</td>
                    <td style="text-align:center" class="bold">02/03/22</td>
                    <td style="text-align:center" class="bold">hdahdah</td>
                    <td style="text-align:center" class="bold">1000</td>
                    <td style="text-align:center" class="bold">bs</td>
                    <td style="text-align:center" class="bold">el marianas</td>
                    <td style="text-align:center" class="bold">mariscal</td>
                    <td style="text-align:center" class="bold">02/02/22</td>
                    <td style="text-align:center" class="bold">1378413</td>
                    <td style="text-align:center" class="bold">V</td>
                    <td style="text-align:center" class="bold">es una observacion</td>
                </tr>
          
        </tbody>
    </table>
       
</body>
</html>

