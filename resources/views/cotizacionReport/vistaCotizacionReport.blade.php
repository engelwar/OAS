@extends('layouts.app')
@section('static', 'statick-side')
@section('estilo')
 <style>
     #divV{
        border-top: 2px dotted #bbb;
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
        <div class="col-md-8 col-lg-6 col-sm-12 border">
        
                <form method="GET"  action="{{ route('Cotizacion.store') }}">
           
                
                <div class=" row d-flex justify-content-center my-3">
                    <div class="d-flex align-items-center justify-content-center">
                        <h3 class="text-primary">REPORTE DE COTIZACION</h3>
                    </div>
                </div>
                <div class="row d-flex justify-content-center"><div class="col-12">
                  <div class="form-group row d-flex justify-content-center">
                    <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm text-right">Desde:</label>
                    <div class="col-sm-4">
                    <input id="fini" type="date" class="form-control form-control-sm " name="fini" value ="{{date('Y-m-d')}}">
                    </div>
                    <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm text-right">Hasta:</label>
                    <div class="col-sm-4">
                    <input id="ffin" type="date" class="form-control form-control-sm " name="ffin" value ="{{date('Y-m-d')}}">
                    </div>
                </div>
                <br>
                    <div class="mb-2 row d-flex justify-content-center">
                        <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm text-right">Vendedor:</label>
                        <div class="col-sm-6">
                            <div class="dropdown">
                                <button id="menu-despl" class="btn btn-default multi-select text-left" type="button" data-bs-toggle="dropdown" aria-expanded="false"><span>  TIPO DE SELECCION: <span class="select-text">(TODOS)</span></span>
                                <span class="caret"></span></button>
                                
                                <ul class="dropdown-menu w-100 scrollable-menu" aria-labelledby="menu-despl">
                                    <!--permisos--->
                                    <li><a href="#" class="multi-select-op">
                                        <label>
                                            <input type="checkbox" checked class="selectall" />
                                            TODOS
                                        </label>
                                        </a></li>
                                        <li><a href="#" class="multi-select-op">
                                            <label>
                                                <input type="checkbox" checked class="selectallI"  />
                                                INSTITUCIONALES
                                            </label>
                                            </a></li>  
                                            <li><a href="#" class="multi-select-op">
                                                <label>
                                                    <input type="checkbox" checked class="selectallM" />
                                                    MAYORISTAS
                                                </label>
                                                </a></li>
                                                <hr class="dotted">
                                        
                                <!------------------->
                          
                             
                            
                                @foreach($array as $u)
                                @if ($u->nombreX=="CARMELA ESCOBAR")
                                <hr class="dotted">
                                @endif
                                    <li class="divider"></li>
                                    <li><a class="option-link multi-select-op" href="#">
                                        <label>
                                            @if ($u->nombreX=="BENIGNA TINTA"||$u->nombreX=="ADRIANA CHAVEZ"||$u->nombreX=="AUDINI CARRILLO"||
                                            $u->nombreX=="INS MARISCAL"||$u->nombreX=="INS BALLIVIAN"||$u->nombreX=="CONTRATOS INSTITUCIONALES"||
                                            $u->nombreX=="INES VELASQUEZ"||$u->nombreX=="GUADALUPE AMBA"||$u->nombreX=="CAJERO 21 CALACOTO" ||$u->nombreX=="PATRICIA ROJAS")
                                             
                                                 @if ($u->nombreX=="CAJERO 21 CALACOTO")
                                                 <input name='options[]' checked type="checkbox" class="optionI justone" value='{{$u->nombreX}}'/> 
                                                21 DE SAN MIGUEL
                                                 @else
                                                 <input name='options[]' checked type="checkbox" class="optionI justone" value='{{$u->nombreX}}'/>
                                                 {{$u->nombreX}}
                                                 @endif
                                                 
                                            @else
                                            <input name='options[]' checked type="checkbox" class="optionM justone" value='{{$u->nombreX}}'/> 
                                            {{$u->nombreX}}
                                            @endif  
                                              
                                     
                                            </label>
                                        </a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- en esta parte es para los filtros para ser portados en pdf y excel-->
                </div>
            </div>
            <br>
            <div class="mb-3 row">
                <div class="col-md-12 d-flex justify-content-center">
                  <button type="submit" class="btn btn-primary mx-2" name="gen" value="ver">
                    Ver <i class="fas fa-bullseye"></i>
                  </button>
                    <button type="submit" class="btn btn-primary mx-2" name="gen" value="export">
                        PDF <i class="fas fa-file-pdf"></i>
                    </button>
                     <button type="submit" class="btn btn-primary mx-2" name="gen" value="excel">
                        Excel <i class="far fa-file-excel"></i>
                    </button>
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
        $('.optionI').prop('checked', true);
        $('.optionM').prop('checked', true);
        $('.selectallI').prop('checked', true);
        $('.selectallM').prop('checked', true);
       
        var total = $('input[name="options[]"]:checked').length;
        $(".dropdown-text").html('(' + total + ') Selected');
        $(".select-text").html('(TODO)');
    } else {
        $('.optionI').prop('checked', false);
        $('.optionM').prop('checked', false);
        $('.selectallI').prop('checked', false);
        $('.selectallM').prop('checked', false);
        $(".dropdown-text").html('(0) Selected');
        $(".select-text").html('');
    }
});
///////institucionales
$('.selectallI').click(function() {
  
   
    if ($(this).is(':checked')) {
        $('.optionI').prop('checked', true);
       
      
        var total = $('input[name="options[]"]:checked').length;
        $(".dropdown-text").html('(' + total + ') Selected');
        $(".select-text").html('(INSTITUCIONAL)');
    } else {
        $('.optionI').prop('checked', false);
        
        $(".dropdown-text").html('(0) Selected');
        $(".select-text").html('');
    }
});

////// mayoristas
$('.selectallM').click(function() {
    
   
    if ($(this).is(':checked')) {
        $('.optionM').prop('checked', true);
        
        var total = $('input[name="options[]"]:checked').length;
        $(".dropdown-text").html('(' + total + ') Selected');
        $(".select-text").html('(MAYORISTA)');
    } else {
        $('.optionM').prop('checked', false);
        $(".dropdown-text").html('(0) Selected');
        $(".select-text").html('');
    }
});



$("input[type='checkbox'].justone").change(function(){
    var a = $("input[type='checkbox'].justone");
    if(a.length == a.filter(":checked").length){
        $('.selectall').prop('checked', true);
        $(".select-text").html('(TODO)');
      
        
    }
    else {
        $('.selectall').prop('checked', false);
      
        $(".select-text").html('');
    }

    
  var total = $('input[name="options[]"]:checked').length;
  $(".dropdown-text").html('(' + total + ') Selected');
});
///////////////////////////////////////



</script>
@endsection
