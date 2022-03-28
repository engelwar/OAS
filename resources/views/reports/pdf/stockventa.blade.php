<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte Ventas Inst/May</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
<style>
body{
    font-size:1rem;
}
</style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <table style="width:100%">
                <tr valign= "middle"> 
                    <td style="width: 20%;">
                        <img alt="foto" src="{{asset('imagenes/logo.png')}}" style="width: 100%;
                        height: auto;"/>      
                    </td>
                    <td style="width: 60%; text-align: center;">
                        <h3 class="text-center">TRASPASO</h3> 
                        <h4>Almacen origen: </h4>              
                        <h4>Almacen destino: Almacen Ballivian</h4>              
                        <h4>Fecha: {{$fffin}}</h4>              
                    </td>
                    <td style="width: 20%; text-align: right;">                
                    </td>
                </tr>                       
            </table>
            <table class="table table-sm table-bordered">
            <thead>
            <tr>
                <th>Categoria</th>
                <th>Codigo</th>
                <th>Descirpcion</th>
                <th>U.M.</th>
                <th>Cantidad</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($query as $item)
                <tr>
                    <td>{{$item->catprod}}</td>
                    <td>{{$item->codprod}}</td>
                    <td>{{$item->desprod}}</td>
                    <td>{{$item->umprod}}</td>
                    <td>{{$item->canprod}}</td>
                </tr>
            @endforeach         
            </tbody>
            </table>        
        </div>
    </div>
</div>
</div>
    </div>
</div>
</body>
</html>

