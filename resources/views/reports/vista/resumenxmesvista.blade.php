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
    <div class="row justify-content-center mt-4 p-5 ">
        <div class="col">
                <table style="width:100%">
                    <tr valign= "middle"> 
                        <td style="width: 20%;">
                            <img alt="foto" src="{{asset('imagenes/logo.png')}}" style="width: 100%;
                            height: auto;"/>      
                        </td>
                        <td style="width: 60%; text-align: right;">
                            <h3 class="text-right">RESUMEN DE VENTAS TOTAL</h3>
                                       
                        </td>
                        <td style="width: 20%; text-align: right;">                
                        </td>
                    </tr>                       
                </table>
            </div>
        </div>
    </div>
  
<table class="table table-sm">

    

    
    <thead>
        <tr class="text-right table-bordered derecha">
            <th></th>
            @foreach ($fxmes as $fx)
            <th colspan="2" style="align-items: center">{{$fx}}</th>
            @endforeach
            <th colspan="2" style="color: red">COMPARATIVO ANUAL</th>
        </tr>
    </thead>

    <thead>
                      
        <tr class="text-right table-bordered derecha">
            <th></th>
            @foreach ($fxmes as $fx)
            <th>2021</th>
            <th>2022</th>
            @endforeach
            <th style="color: red">2021</th>
                        <th style="color: red">2022</th>
        </tr>
    </thead>
    <tbody>
        
        <tr class="text-right table-bordered font-weight-bold derecha" style = "background:#e6ecff;border-top:solid #000 1px">
            <td style="text-align:left" class="bold">SUMA GENERAL</td>
        <!--enero-->
          @if (is_null($tarray1))
              
          @else
          @foreach ($tarray1 as $key=>$val)
          @if (is_null($val))
              <td class="bold">0</td>
          @else
              <td class="bold">{{$val}}</td>
          @endif
          @endforeach
          @endif
        <!--febrero-->
        @if (is_null($tarray2))
              
          @else
          @foreach ($tarray2 as $key=>$val)
          @if (is_null($val))
              <td class="bold">0</td>
          @else
              <td class="bold">{{$val}}</td>
          @endif
          @endforeach
          @endif
          <!--marzo-->
          @if (is_null($tarray3))
              
          @else
          @foreach ($tarray3 as $key=>$val)
          @if (is_null($val))
              <td class="bold">0</td>
          @else
              <td class="bold">{{$val}}</td>
          @endif
          @endforeach
          @endif
          <!--abril-->
          @if (is_null($tarray4))
              
          @else
          @foreach ($tarray4 as $key=>$val)
          @if (is_null($val))
              <td class="bold">0</td>
          @else
              <td class="bold">{{$val}}</td>
          @endif
          @endforeach
          @endif
            <!--mayo-->
            @if (is_null($tarray5))
              
          @else
          @foreach ($tarray5 as $key=>$val)
          @if (is_null($val))
              <td class="bold">0</td>
          @else
              <td class="bold">{{$val}}</td>
          @endif
          @endforeach
          @endif

            <!--junio--->
            @if (is_null($tarray6))
              
            @else
            @foreach ($tarray6 as $key=>$val)
            @if (is_null($val))
                <td class="bold">0</td>
            @else
                <td class="bold">{{$val}}</td>
            @endif
            @endforeach
            @endif
            <!--julio-->
            
         
            @foreach ($tarray7 as $key=>$val)
            @if (is_null($val))
                <td class="bold">0</td>
            @else
                <td class="bold">{{$val}}</td>
            @endif
            @endforeach
          
            @foreach ($tarray8 as $key=>$val)
            @if (is_null($val))
                <td class="bold">0</td>
            @else
                <td class="bold">{{$val}}</td>
            @endif
            @endforeach


            @foreach ($tarray9 as $key=>$val)
            @if (is_null($val))
                <td class="bold">0</td>
            @else
                <td class="bold">{{$val}}</td>
            @endif
            @endforeach
         
            @foreach ($tarray10 as $key=>$val)
            @if (is_null($val))
                <td class="bold">0</td>
            @else
                <td class="bold">{{$val}}</td>
            @endif
            @endforeach

            @foreach ($tarray11 as $key=>$val)
            @if (is_null($val))
                <td class="bold">0</td>
            @else
                <td class="bold">{{$val}}</td>
            @endif
            @endforeach

            @foreach ($tarray12 as $key=>$val)
            @if (is_null($val))
                <td class="bold">0</td>
            @else
                <td class="bold">{{$val}}</td>
            @endif
            @endforeach
            @foreach ($tarrayAnual as $key=>$val)
            @if (is_null($val))
                <td class="bold">0</td>
            @else
                <td class="bold">{{$val}}</td>
            @endif
            @endforeach
            
        </tr>  

        




 




     
    </tbody>
<!---prueba-->
@foreach($resumen2 as $f => $g)                                   
                     
<tbody>
    @if($g)
    @foreach($total2[$f] as $h => $i)
    <tr class="text-right table-bordered font-weight-bold derecha" style = "background:#e6ecff;border-top:1.1px solid #000">
    <td style="text-align:left" class="bold">SUCURSAL {{$f}}</td>
  
    <td class="bold">{{$i->Total}}</td>
    
  
    <td>0</td>
    </tr> 
@endforeach
        @foreach($g as $h => $i)
            <tr class="text-right table-bordered derecha">
                <td style="text-align:left" class="bold">{{$i->Tipo}}</td>
           
    <td class="bold">{{$i->Total}}</td>
    
    <td>0</td>
            </tr>
        @endforeach
        
    @endif  
 
</tbody>
@endforeach








 


    
<thead>
</table>

           
                <table class = "table table-sm">
                @if($resumen)
                <thead>
                      
                    <tr class="text-right table-bordered derecha">
                        <th></th>
                        <th colspan="2">ENERO</th>
                        <th colspan="2">FEBRERO</th>
                        <th colspan="2">MARZO</th>
                        <th colspan="2">ABRIR</th>
                        <th colspan="2">MAYO</th>
                        <th colspan="2">JUNIO</th>
                        <th colspan="2">JULIO</th>
                        <th colspan="2">AGOSTO</th>
                        <th colspan="2">SEPTIEMBRE</th>
                        <th colspan="2">OCTUBRE</th>
                        <th colspan="2">NOVIEMBRE</th>
                        <th colspan="2">DICIEMBRE</th>
                        <th colspan="2" style="color: red">COMPARATIVO ANUAL</th>
                        
                  
                    </tr>
                </thead>
                <thead>
                      
                    <tr class="text-right table-bordered derecha">
                        <th></th>
                        <th>2021</th>
                        <th>2022</th>
                        <th>2021</th>
                        <th>2022</th>
                        <th>2021</th>
                        <th>2022</th>
                        <th>2021</th>
                        <th>2022</th>
                        <th>2021</th>
                        <th>2022</th>
                        <th>2021</th>
                        <th>2022</th>
                        <th>2021</th>
                        <th>2022</th>
                        <th>2021</th>
                        <th>2022</th>
                        <th>2021</th>
                        <th>2022</th>
                        <th>2021</th>
                        <th>2022</th>
                        <th>2021</th>
                        <th>2022</th>
                        <th>2021</th>
                        <th>2022</th>
                        <th style="color: red">2021</th>
                        <th style="color: red">2022</th>
                  
                    </tr>
                </thead>
                <tbody>
                    @foreach($totalgen as $i)
                        <tr class="text-right table-bordered font-weight-bold derecha" style = "background:#e6ecff;border-top:solid #000 1px">
                            <td style="text-align:left" class="bold">SUMA GENERAL</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td class="bold">{{$i->Total}}</td>
                            <td>0</td>
                           
                      
                        </tr> 
                    @endforeach
                </tbody>
                    @foreach($resumen as $f => $g)                                   
                     
                        <tbody>
                            @if($g)
                            @foreach($total[$f] as $h => $i)
                            <tr class="text-right table-bordered font-weight-bold derecha" style = "background:#e6ecff;border-top:1.1px solid #000">
                            <td style="text-align:left" class="bold">SUCURSAL {{$f}}</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td class="bold">{{$i->Total}}</td>
                            <td>0</td>
                          
                             
                            </tr> 
                        @endforeach
                                @foreach($g as $h => $i)
                                    <tr class="text-right table-bordered derecha">
                                        <td style="text-align:left" class="bold">{{$i->Tipo}}</td>
                                        <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td class="bold">{{$i->Total}}</td>
                            <td>0</td>
                            
                                    </tr>
                                @endforeach
                            @endif  
                         
                        </tbody>
                    @endforeach
                 

                        
                <thead>
                       
                    @foreach($resumenAdmin as $f => $g)                                   
                
                    <tbody>
                        @if($g)
                        @foreach($totalQ[$f] as $h => $i)
                            <tr class="text-right table-bordered font-weight-bold derecha" style = "background:#e6ecff;border-top:1.1px solid #000">
                                <td style="text-align:left" class="bold">TOTAL ADMINISTRACION</td>
                                <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td class="bold">{{$i->Total}}</td>
                            <td>0</td>
                         
                            </tr> 
                        @endforeach
                            @foreach($g as $h => $i)
                                <tr class="text-right table-bordered derecha">
                                    <td style="text-align:left" class="bold">{{$i->Tipo}}</td>
                                    <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td class="bold">{{$i->Total}}</td>
                            <td>0</td>
                                    
                                  
                                </tr>
                            @endforeach
                        @endif  
                        
                    </tbody>
                @endforeach
                </thead>

                @endif  
                
                
                </table> 
                       
  
@endsection

@section('mis_scripts')
<script>
$(".page-wrapper").removeClass("toggled"); 
</script>
@endsection
