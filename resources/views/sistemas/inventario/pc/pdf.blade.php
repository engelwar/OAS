<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        @page { margin: 2.5cm 2.5cm 2.5cm 3cm; }

        .page-number:before {
        content: "Pagina " counter(page);
        }
        table, th, td {
  border: 1px solid black;
}
    </style>
</head>
<!--div id="footer">
  <div class="page-number"></div>
</div-->
<body>
    <table style="width:100%">
        <tr>
            <td style="width: 25%;">
                <img alt="foto" src="{{asset('imagenes/logo.png')}}" style="width: 100%;
height: auto;"/>      
            </td>
            <td style="width: 50%; text-align: center;">
                <p>INVENTARIO SISTEMAS</p>                
            </td>
            <td style="width: 25%; text-align: right;">
                
            </td>
        </tr>                       
    </table>
    @if($form->count())
        @foreach($form as $f)
            <table style="border:solid; width:100%; margin-top:10px">
                <tr>
                    <td style="text-align:center" class="bold" colspan=3>ID: {{$f->id}}</td>
                </tr>
                <tr>
                    <td style="width:70%" colspan=2>
                        <p><span class="bold">IP: </span>{{$f->ip}} , <span class="bold">Ubicacion: </span>{{$f->ubicacion}}</p>
                        @foreach($f->dispositivo as $dis)
 
                            <span class="bold">{{$dis->tipo}}</span>: {{$dis->caracteristicas}} ,
                           
                        @endforeach
                    </td>
</tr><tr>
                    <td style="width:30%">

                    </td>
                </tr>
                </table>
        @endforeach
    @endif       
</body>
</html>

