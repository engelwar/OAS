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
          <form method="POST" action="">
              @csrf
              <div class=" row d-flex justify-content-center my-3">
                  <div class="d-flex align-items-center justify-content-center">
                      <h3 class="text-primary">GENERADOR DE CARTAS DE CXC</h3>
                  </div>
              </div>


              <div class="row">
                <div class="col-sm-6">
                  <div class="card">
                    <div class="card-body">
                      <h5 class="card-title">Generador total</h5>
                      <p class="card-text">Genera todos los clientes segun un rango de fecha </p>
                      <form method="GET" target="_blank" action="{{ route('GeneradorCartas.store') }}">
                      <input disabled id="fini" type="date" class="form-control form-control-sm " name="fini" value ="{{date('Y-m-d')}}">
                      <input disabled id="ffin" style="visibility: hidden" type="date" class="form-control form-control-sm " name="ffin" value ="{{date('Y-m-d')}}">
                      <div class="mb-2 row d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary mx-2" name="genPDF" value="export" disabled>
                      PDF <i class="fas fa-file-pdf"></i>
                  </button>
                </form>
                  </div>
                   
                    
                    </div>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="card">
                    <div class="card-body">
                      <h5 class="card-title">Generador especifico</h5>
                      <p class="card-text">Genera segun un rago de fecha pero se puede escojer los clientes</p>
                      <form method="GET" target="_blank" action="{{ route('GeneradorCartas.store') }}">

                      <input id="fini" type="date" class="form-control form-control-sm " name="fini" value ="{{date('Y-m-d')}}">
                      <input id="ffin" style="visibility: hidden" type="date" class="form-control form-control-sm " name="ffin" value ="{{date('Y-m-d')}}">
                      <div class="mb-2 row d-flex justify-content-center">
                      <button type="submit" class="btn btn-primary mx-1" name="genVer" value="ver">
                        Ver clientes  <i class="fas fa-bullseye"></i>
                      </button>
                    </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>


         <br>
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
