@extends('layouts.app')


@include('layouts.sidebar', ['hide'=>'1']) 
@section('estilo')
 <style>
  .circuloR {
    margin-top: 4px;
    position: absolute;
    width: 40px; 
     height: 80px; 
     
     background: #e73002;
     -moz-border-radius: 0 100px 100px 0;
     -webkit-border-radius: 0 100px 100px 0;
     border-radius: 0 100px 100px 0;
}
.circuloA {
  margin-top: 91px;
    position: absolute;
    width: 40px; 
     height: 80px;
     
     background: #0202e7;
     -moz-border-radius: 0 100px 100px 0;
     -webkit-border-radius: 0 100px 100px 0;
     border-radius: 0 100px 100px 0;
}
.circuloAma {
  position: absolute;
  margin-top: 46px;
  margin-left: 33px;
     width: 80px;
     height: 80px;
     -moz-border-radius: 50%;
     -webkit-border-radius: 50%;
     border-radius: 50%;
     background: #ffee00;
}
  .btn_ini {
	color: rgb(0, 0, 0);

  cursor: pointer;


	font-size:0.8em;

  transition: all 0.5s ease-in-out;
}



.btn_ini:hover{
	background-color: rgba(66, 98, 195, 0.534);
}


  .rectangulo {
     width: 480px; 
     height: 180px; 
     border: 3px solid rgb(13, 0, 0);
    
}


 .multi-select
 {
    display: block;
    width: 100%;
    font-weight: 400;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-radius: 0.25rem;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    height: auto;
    height: calc(1.5em + 0.5rem + 2px);
    padding: 0.25rem 0.5rem;
    font-size: 0.7875rem;
    line-height: 1.5;
    overflow: hidden;
    white-space: nowrap;
    border-radius: 0.2rem;
    text-align: left; 
 }

 .multi-select-op
 {
    clear: both;
    display: inline-block;
    overflow: hidden;
    white-space: nowrap;
    width: 100%;
    padding: 0.375rem 0.75rem;
    font-size: 0.8rem;
    font-weight: 400;
    line-height: 1.6;
    color: #495057;
    background-color: #fff;

    height: auto;
    height: calc(1.5em + 0.5rem + 2px);
    padding: 0.25rem 0.5rem;
    font-size: 0.7875rem;
    line-height: 1.5;
 }
 .scrollable-menu {
    height: auto;
    max-height: 200px;
    overflow-x: scroll;
}
 </style>
@endsection
@section('content')
@include('layouts.sidebar', ['hide'=>'1']) 


<div class="container">
    <div class="row justify-content-center mt-4">
        <div class="col-md-6 col-lg-6 col-sm-12 border">
            
                <div class=" row d-flex justify-content-center my-3">
                    <div class="d-flex align-items-center justify-content-center">
                        <h3 class="text-primary">REGISTRO DE DISPOSITIVOS</h3>
                    </div>
                </div>
                <div class="row">
                
                    <div class="col-sm-6">
                      <div class="card">
                        <div class="card-body">
                          <h5 class="card-title">Registrar dispositivo</h5>
                        
                          <p class="card-text">Añade nuevos dispositovos.</p>
                          <form method="GET" target="_blank" action="{{ route('ReguistroPC.store') }}">
                          <button type="submit" class="btn btn-primary mx-2" name="gen" value="ver">
                            Registrar <i class="fas fa-bullseye"></i>
                        </button>
                          </form>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card">
                          <div class="card-body">
                            <h5 class="card-title">Caracteristicas</h5>
                          
                            <p class="card-text">Solo es una muestra como esta estructurado .</p>
                            <form method="GET" target="_blank" action="{{ route('ReguistroPC.store') }}">
                            <button type="submit" class="btn btn-primary mx-2" name="gen" value="ver">
                              Empezar <i class="fas fa-bullseye"></i>
                          </button>
                            </form>
                          </div>
                        </div>
                      </div>
                  </div>
            <div class="mb-3 row">
                <div class="col-md-12 d-flex justify-content-center">
                
                    
            
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('mis_scripts')
<script>
$( ".dropdown-menu" ).click(function() {
    $('.dropdown-menu').parent().is(".open") && e.stopPropagation();
});

$('.selectall').click(function() {
    if ($(this).is(':checked')) {
        $('.option').prop('checked', true);
        var total = $('input[name="options[]"]:checked').length;
        $(".dropdown-text").html('(' + total + ') Selected');
        $(".select-text").html('(TODOS)');
    } else {
        $('.option').prop('checked', false);
        $(".dropdown-text").html('(0) Selected');
        $(".select-text").html('');
    }
});

$("input[type='checkbox'].justone").change(function(){
    var a = $("input[type='checkbox'].justone");
    if(a.length == a.filter(":checked").length){
        $('.selectall').prop('checked', true);
        $(".select-text").html('(TODOS)');
    }
    else {
        $('.selectall').prop('checked', false);
        $(".select-text").html('');
    }
  var total = $('input[name="options[]"]:checked').length;
  $(".dropdown-text").html('(' + total + ') Selected');
});
</script>

@endsection
