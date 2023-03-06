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
    <div class="row justify-content-center mt-12 p-5 border">
        <div class="col">
                <table style="width:100%">
                    <tr valign= "middle"> 
                        <td style="width: 20%;">
                            <img alt="foto" src="{{asset('imagenes/logo.png')}}" style="width: 100%;
                            height: auto;"/>      
                        </td>
                        <td style="width: 60%; text-align: center;">
                            <h3 class="text-center">RESUMEN TOTAL DE VENTAS DETALLADO</h3>
                              
                        </td>
                        <td style="width: 20%; text-align: right;">                
                        </td>
                    </tr>                       
                </table>
              
                <table id="example" class="display" style="width:100%">
                    <thead>
                        <tr>
                         <th>Accion</th> 
                    <th>Local</th>
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
                        @foreach ($queryNivel1 as $item)
                        <tr>
                         <td>
                       
                                <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                  Link with href
                                </a>
                               
                     
                         </td>
                            <td>{{$item->Local}}</td>
                            <td>{{$item->Total}}</td>
                            <td>{{$item->Moneda}}</td>
                            <td>{{$item->Efectivo}}</td>
                            <td>{{$item->Banco}}</td>
                            <td>{{$item->CXC}}</td>
                            <td>{{$item->Tarjeta}}</td>
                            <td>{{$item->MotCont}}</td>
                            <td>{{$item->Otros}}</td>
                            
                           
                        </tr>
                      
                        @endforeach
                    </tbody>   

                </table>
              
                       
        </div>
    </div>
</div>
@endsection


@section('mis_scripts')


<script>
$(document).ready(function () {
    $('#example').DataTable();
});
$(".page-wrapper").removeClass("toggled"); 
</script>





@endsection
