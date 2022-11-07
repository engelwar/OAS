@extends('layouts.app')
@section('static', 'statick-side')
@section('estilo')
 <style>
  .mifecha {
   background-color: #999;
   padding: 3px;
   width: 110px;
   text-align: center;
   font-family:verdana, arial;
   font-size: 12pt;
}
.mifecha .ano{
   background-color: #339;
   padding: 2px;
   font-size: 100%;
   margin-bottom: 3px;
   color: #fff;
   letter-spacing: 3px;
   font-weight: bold;
}
.mifecha .dia{
   background-color: #99f;
   font-size: 300%;
   padding: 5px 8px;
   margin-bottom: 3px;
   font-weight: bold;
}
.mifecha .mes{
   background-color: #339;
   font-size: 80%;
   padding: 2px;
   color: #fff;
   font-weight: bold;
}
 </style>
@endsection
@section('content')
@include('layouts.sidebar', ['hide'=>'1']) 


<div class="container">
    <div class="row justify-content-center mt-4">
        <div class="col-md-8 col-lg-6 col-sm-12 border">
        
                <form method="GET"  action="">
           
                
                <div class=" row d-flex justify-content-center my-3">
                    <div class="d-flex align-items-center justify-content-center">
                        <h3 class="text-primary">GENERADOR DE CARTAS</h3>
                      
                    </div>
                    <h4 class="text-primary">  
                        
                        <div id="fechaX" style="align-content: center;text-align: center"></div></h4>
                </div>
                <br>
                <div class="mb-3 row">
                    <div class="col-md-12 d-flex justify-content-center">

                        <form method="POST" action="{{route('GeneradorCartas.perfil')}}" target="_blank">
                            @csrf
                            <input type="hidden" id="{{Auth::user()->id}}USER" name="USER" maxlength="8" size="10" value="{{Auth::user()->id}}">
    
                      <button type="sumit" class="btn btn-primary "    id="{{Auth::user()->id}}USER">CARTA </button>
                      
                      </form> 
                     
                      <h6>{{Auth::user()}}</h6>
                      <button type="submit" class="btn btn-outline-primary mx-2" name="gen" value="ver">
                        Modo Administrador <i class="fas fa-bullseye"></i>
                      </button>
                    </div>
                </div>
                <div class="row d-flex justify-content-center"><div class="col-12">
                  <div class="form-group row d-flex justify-content-center">

                    <div class="col-sm-4">
                    <input id="fini" type="hidden" class="form-control form-control-sm hidden" name="fini" value ="{{date('Y-m-d')}}" >
                    </div>

                    <div class="col-sm-4">

                     
                  
                    </div>
                
                   
         
        </div>
    </div>
</div>

@endsection
@section('mis_scripts')

    <script>
        const d = new Date();
        let text = d.toLocaleDateString();
       
    document.getElementById("fechaX").innerHTML = text;
    </script>

    <script>
        //////////////PARA OBTENER EL ID  y mostrar la ventana //////////////////////////
function obtenerIdFAC(id){
  idx="#"+id;
  $(idx).click(function(){
    
  $("#exampleModalFAC").modal("show");
});
var fila;
$(document).on("click",".btnHTFAC", function(){
  fila=$(this).closest("tr");
  ids=parseInt(fila.find('td:eq(4)').text());
  $("#nameFAC").val(id);
}); 

  
}
    </script>
@endsection
