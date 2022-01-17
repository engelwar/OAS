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
                            <h3 class="text-center">RESUMEN DE VENTAS</h3>
                            <h6 class="text-center">DEL {{$fini}} AL {{$ffin}}</h6>               
                        </td>
                        <td style="width: 20%; text-align: right;">                
                        </td>
                    </tr>                       
                </table>
                <table class = "table table-sm">
                @if($resumen)
                @foreach($resumen as $f => $g)                                   
                    <thead>
                        <tr>
                            <td style = "border-style:none; padding-top:35px" colspan=9><h4>{{$f}}</h4></td>
                        </tr>
                        <tr class="text-right table-bordered ">
                            <th></th>
                            <th>Total</th>
                            <th>Moneda</th>
                            <th>Efectivo</th>
                            <th>Banco</th>
                            <th>CXC</th>
                            <th>Tarjeta</th>
                            <th>MotCont</th>
                            <th>Otros</th>
                        </tr>
                    </thead>
                    <tbody>
                    @if($g)
                        @foreach($g as $h => $i)
                            <tr class="text-right table-bordered">
                                <td style="text-align:left" class="bold">{{$i->Tipo}}</td>
                                <td class="bold">{{$i->Total}}</td>
                                <td class="bold">{{$i->Moneda}}</td>
                                <td class="bold">{{$i->Efectivo}}</td>
                                <td class="bold">{{$i->Banco}}</td>
                                <td class="bold">{{$i->CXC}}</td>
                                <td class="bold">{{$i->Tarjeta}}</td>
                                <td class="bold">{{$i->MotCont}}</td>
                                <td class="bold">{{$i->Otros}}</td>
                            </tr>                           
                        @endforeach
                    @endif 
                        @foreach($total[$f] as $h => $i)
                            <tr class="text-right table-bordered font-weight-bold" style = "background:#e6ecff">
                                <td style="text-align:left" class="bold">TOTAL {{$f}}</td>
                                <td class="bold">{{$i->Total}}</td>
                                <td class="bold">{{$i->Moneda}}</td>
                                <td class="bold">{{$i->Efectivo}}</td>
                                <td class="bold">{{$i->Banco}}</td>
                                <td class="bold">{{$i->CXC}}</td>
                                <td class="bold">{{$i->Tarjeta}}</td>
                                <td class="bold">{{$i->MotCont}}</td>
                                <td class="bold">{{$i->Otros}}</td>
                            </tr> 
                        @endforeach
                    </tbody>
                    @endforeach
            @endif   
                </table> 
                       
        </div>
    </div>
</div>
</body>
</html>
