@extends('layouts.app')

@section('estilo')
<style>
body{
    font-size:0.9rem;
}
.derecha td, .derecha th{
    text-align: end;
}
</style>
@endsection
@section('content')
@include('layouts.sidebar', ['hide'=>'0']) 
<div class="container">
    <div class="row justify-content-center mt-4 p-5 border">
        <div class="col">
                <table style="width:100%">
                    <tr valign= "middle"> 
                        <td style="width: 20%;">
                            <img alt="foto" src="{{asset('imagenes/logo.png')}}" style="width: 100%;
                            height: auto;"/>      
                        </td>
                        <td style="width: 60%; text-align: center;">
                            <h3 class="text-center">RESUMEN DE VENTAS TOTAL</h3>
                            <h6 class="text-center">DEL {{$fini}} AL {{$ffin}}</h6>               
                        </td>
                        <td style="width: 20%; text-align: right;">                
                        </td>
                    </tr>                       
                </table>

                <div class="col-md-auto">
                   <button type="button" class="btn btn-outline-success" id="exportar">Exportar a excel
   
                   </button>
    
                  </div>
                
                <table class = "table table-sm" id="miTabla">
                @if($resumen)
                
                 
                <thead>
                       
                    @foreach($resumenAdmin as $f => $g)                                   
                    <thead>
                        <tr>
                            <td style = "border-style:none; padding-top:35px" colspan=9><h4>USO INTERNO -  ADMINISTRACION</h4></td>
                        </tr>
                        <tr class="texttable-bordered derecha">
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
                                <tr class="text-right table-bordered derecha">
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
                        @foreach($totalQ[$f] as $h => $i)
                            <tr class="text-right table-bordered font-weight-bold derecha" style = "background:#e6ecff;border-top:1.1px solid #000">
                                <td style="text-align:left" class="bold">TOTAL ADMINISTRACION</td>
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
                </thead>

                    @foreach($resumen as $f => $g)                                   
                        <thead>
                            <tr>
                                <td style = "border-style:none; padding-top:35px" colspan=9><h4>{{$f}}</h4></td>
                            </tr>
                            <tr class="texttable-bordered derecha">
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
                                    <tr class="text-right table-bordered derecha">
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
                                <tr class="text-right table-bordered font-weight-bold derecha" style = "background:#e6ecff;border-top:1.1px solid #000">
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

                    <thead>
                       
                        @foreach($region1 as $f => $g)                                   
                        <thead>
                            <tr>
                                <td style = "border-style:none; padding-top:35px" colspan=9><h4>REGIONAL 1</h4></td>
                            </tr>
                            <tr class="texttable-bordered derecha">
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
                                    <tr class="text-right table-bordered derecha">
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
                            @foreach($totalG[$f] as $h => $i)
                                <tr class="text-right table-bordered font-weight-bold derecha" style = "background:#e6ecff;border-top:1.1px solid #000">
                                    <td style="text-align:left" class="bold">TOTAL REGIONAL 1</td>
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
                    </thead>


                    
                    <thead>
                       
                        @foreach($region2 as $f => $g)                                   
                        <thead>
                            <tr>
                                <td style = "border-style:none; padding-top:35px" colspan=9><h4>REGIONAL 2</h4></td>
                            </tr>
                            <tr class="texttable-bordered derecha">
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
                                    <tr class="text-right table-bordered derecha">
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
                            @foreach($totalG2[$f] as $h => $i)
                                <tr class="text-right table-bordered font-weight-bold derecha" style = "background:#e6ecff;border-top:1.1px solid #000">
                                    <td style="text-align:left" class="bold">TOTAL REGIONAL 2</td>
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
                    </thead>
                    <thead>
                        <tr>
                            <td style = "border-style:none; padding-top:35px" colspan=9><h4>TOTAL GENERAL</h4></td>
                        </tr>
                        <tr class="text-right table-bordered derecha">
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
                        @foreach($totalgen as $i)
                            <tr class="text-right table-bordered font-weight-bold derecha" style = "background:#e6ecff;border-top:solid #000 1px">
                                <td style="text-align:left" class="bold">TOTAL GENERAL</td>
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

                    
                @endif  
                
                
                </table> 
                       
        </div>
    </div>
</div>
@endsection


@section('mis_scripts')

<script src="//ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="//cdn.rawgit.com/rainabba/jquery-table2excel/1.1.0/dist/jquery.table2excel.min.js"></script>


<script>
  $(document).ready(()=>{
    $("#exportar").click(function(){
  $("#miTabla").table2excel({
    // exclude CSS class
    exclude: ".noExl",
    name: "Worksheet Name",
    filename: "resumendeventastotal", //do not include extension
    fileext: ".xls" // file extension
  }); 
});
  });

</script>
<script>
$(".page-wrapper").removeClass("toggled"); 
</script>





@endsection
