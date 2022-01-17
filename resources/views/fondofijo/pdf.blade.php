<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <style>
        @font-face {
            font-family: "fuente";
            src: url('{{storage_path("fonts/light.ttf")}}') format("truetype");;
        }
        @font-face {
            font-family: "bold";
            src: url('{{storage_path("fonts/futura_book.ttf")}}') format("truetype");
            font-weight: bold;
        }
        html
        { 
            font-family: "fuente" !important;            
        }
        .bold
        { 
            font-family: "bold" !important;
            
        }
        @page { margin: 0.5cm 1cm 0.5cm 0.5cm; }

        .page-number:before {
        content: "Pagina " counter(page);
        }
        .borde th, .borde td{
  border: 1px solid black;
  
}
.borde_colapse{
    border-collapse: collapse;
}
    </style>
</head>
<!--div id="footer">
  <div class="page-number"></div>
</div-->
<body>
    <table style="width:100%;">
        <tr>
            <td style="width: 20%;">
                <img alt="foto" src="{{asset('imagenes/logo.png')}}" style="width: 100%;
height: auto;"/>      
            </td>
            <td style="width: 60%; text-align: center;">
                LIBRETA DE FONDO FIJO<br> 
                {{$form->unidad}}               
            </td>
            <td style="width: 20%; text-align: right;">
                
            </td>
        </tr>                       
    </table>         
    <table style="margin-top:10px; font-size: 0.75rem; width:100%" class="borde_colapse borde">
        <thead>
            <tr class="bold borde">
                <th style="width:70px">Fecha</th>
                <th style="width:50px">Centro de Costo</th>
                <th style="width:50px">Cuenta Contable</th>
                <th style="width:50px">Responsable</th>
                <th style="width:50px">Razon Social</th>
                <th style="width:50px">Concepto</th>
                <th style="width:80px">Nro. factura o Documento</th>
                <th style="width:80px">Nro. Recibo</th>
                <th style="width:50px">Debe</th>
                <th style="width:50px">Haber</th>
                <th style="width:50px">Saldo</th>                
            </tr>
        </thead>
        <tbody>
            @if($form->count())   
            @foreach($data as $d)
                <tr>
                    <td>{{$d->fecha}}</td>
                    <td>{{$d->centro_c}}</td>
                    <td>{{$d->cuenta_c}}</td>
                    <td>{{$d->user->nombre}}</td>
                    <td>{{$d->razon_s}}</td>
                    <td>{{$d->concepto}}</td>
                    <td>{{$d->n_fac}}</td>
                    <td>{{$d->n_recib}}</td>
                    <td>{{$d->debe}}</td>
                    <td>{{$d->haber}}</td>
                    <td>{{$d->saldo}}</td>
                </tr>
            @endforeach
            @endif
        </tbody>
    </table> 
    <table style="width:100%; margin-top: 50px;">
        <tr>
            <td style="width: 100%; text-align: center;font-size: 0.9rem;">
               _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ <br>
                RESPONSABLE DE FONDO FIJO<br> 
                {{$form->user->perfiles->nombre .' '.$form->user->perfiles->paterno.' '.$form->user->perfiles->materno .' - '.$form->user->perfiles->cargo}}                
            </td>
        </tr>                       
    </table>              
</body>
</html>

