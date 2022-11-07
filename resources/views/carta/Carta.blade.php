<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generador de cartas</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">   
        
    <style>
        .estiloA{
            background: chocolate;
        }

        body{
            font-size:0.8rem;
        }
    </style>
</head>
<body>
      
    <table style="width:100%">
        <tr valign= "middle"> 
            <img alt="foto" style="estiloA" id="estiloA" src="{{asset('imagenes/icon.png')}}" style="width: 20%;
            height: auto;"/> 
            
            <td style="width: 20%;">
                <img alt="foto" src="{{asset('imagenes/logo2.png')}}" style="width: 100%;
                height: auto;"/>      
             
            </td>
            <td style="width: 60%; text-align: center;">
                <h4>FORMATO DE CARTA</h4>       
                <h5>FECHA: ----</h5>
                             
            </td>
            <td style="width: 20%; text-align: right;">                
            </td>
        </tr>                       
    </table>
    <H3 class="mt-5">CARTA</H3>
    <table class = "table table-bordered table-sm">
        
    </table>
   
   
</body>
</html>

