@extends('layouts.app')
@section('static', 'statick-side')
@section('estilo')
 <style>
  .contenido{
    padding-top: 25px;

  }
  .contenedor{
    position: relative;
  }
  .medio{
    position: absolute;
    top: 20%;
    left: 5%;
  }
  .selectAltura {
  display:block;
  height:30px;
  width:150px;
}

 </style>
@endsection
@section('content')
@include('layouts.sidebar', ['hide'=>'1']) 


<div class="container border rounded">


   
       <div class="row pt-1 border-primary" style="margin-top:2px; border-top: solid;">
         <div class="col-12 d-flex justify-content-center" style="padding-top: 10px"><h3>GENERADOR DE CARTAS</h3></div>
       </div>
      
    <div class="contenido">
    
        <table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Cliente</th>
               
                <th>Accion</th>
                 
            </tr>
        </thead>
        <tbody>
            @foreach ($nameCxc2 as $key=> $ver)
           
                
            <tr>
               
                <td>{{$ver->Cliente}} 
                </td>
                
          
                <td>
                    <form method="POST" target="_blank" action="{{ route('GeneradorCartas.carta') }}">
                        @csrf
                    <input type="text" id="{{$key}}" value="{{$ver->Cliente}}" name="cli" style="visibility: hidden;width: 5px">
                    <input type="text" id="{{$key}}" value="{{$fecha}}" name="fecha" style="visibility: hidden;width: 5px">
                    <input type="text" id="{{$key}}" value="{{$fechaCarta}}" name="fechaCarta" style="visibility: hidden;width: 5px">
                    <input type="text" id="{{$key}}" value="{{$fechaC}}" name="fechaC" style="visibility: hidden;width: 5px">
                    <input type="text" id="{{$key}}" value="{{$fechaH}}" name="fechaH" style="visibility: hidden;width: 5px">
                    <input type="number" id="{{$key}}" value="1" name="conta" style="visibility: hidden;width: 5px">
                    <div class="container">
                        <div class="row">
                          <div class="col">
                         
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="radio" value="Señor" id="flexRadioDefault1">
                                <label class="form-check-label" for="flexRadioDefault1">
                                  Señor
                                </label>
                              </div>
                           </div>   
                           <div class="col">
                           <div class="form-check">
                                <input class="form-check-input" type="radio" name="radio" value="Señora" id="flexRadioDefault2">
                                <label class="form-check-label" for="flexRadioDefault2">
                                  Señora
                                </label>
                              </div>
                            </div>
                            <div class="col"> 
                              <div class="form-check">
                                <input class="form-check-input" type="radio" name="radio" value="Señores" id="flexRadioDefault3" checked>
                                <label class="form-check-label" for="flexRadioDefault3">
                                  Señores
                                </label>
                              </div>
                              </div>
                           
                            <div class="col">
                    
                                <button type="submit" class="btn btn-secondary" id="{{$key}}" name="verC" value="verC">Generar </button>   
                                  
                              </div>
                          </div>
                       
                    
                        </div>
                      </div>
                   
               
                     
                        </form>
       
                </td>    
       
                
            </tr>

            @endforeach
        </tbody>
        </table>    
  

    </div>






      
      
           
         </div>


@endsection
@section('mis_scripts')
<script>
$(document).ready(function () {
    $('#example').DataTable({
        scrollY: '500px',
        scrollCollapse: true,
        paging: false,
    });
});
</script>

  
@endsection
