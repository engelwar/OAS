@extends('layouts.app')
@section('static', 'statick-side')
@section('estilo')
 <style>
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
        <div class="col-md-8 border">
            
            <form method="POST" target="_blank" action="{{ route('resumenventaspormes.store') }}">
                @csrf
                <div class=" row d-flex justify-content-center my-3">
                    
                        <h3 class="text-center text-primary">RESUMEN TOTAL DE VENTAS POR MES</h3>
                        
                </div>
                
            <div class="form-group row">
               <!--style="visibility: hidden"-->
                <div class="row d-flex justify-content-center" >
                    <div class="col-10">
                    <div class="form-group row d-flex justify-content-center">
                        <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm text-right">Desde:</label>
                        <div class="col-sm-4">
                        <input id="fini" type="date" class="form-control form-control-sm " name="fini" value ="{{date('2021-01-01')}}">
                       
                        <div class="mb-2 row d-flex justify-content-center">
                            <label for="colFormLabelSm" class="col-sm-6 col-form-label col-form-label-sm text-right">2021/2022:</label>
                            <div class="col-sm-6">
                                <div class="dropdown">
                                    <button id="menu-despl" class="btn btn-default multi-select text-left" type="button" data-bs-toggle="dropdown" aria-expanded="false"><span>MES<span class="select-text">(TODOS)</span></span>
                                    <span class="caret"></span></button>
                                    <ul class="dropdown-menu w-100 scrollable-menu" aria-labelledby="menu-despl">
                                       <li><a href="#" class="multi-select-op">
                                            <label>
                                                <input type="checkbox" checked class="selectall" />
                                                TODOS
                                            </label>
                                            </a></li>
                                       
                             
                                        <li class="divider"></li>
                                        <li><a class="option-link multi-select-op" href="#">
                                            <label>
                                                <input name='options[]' checked type="checkbox" class="option justone" value="ENERO"/> 
                                               ENERO
                                                </label>
                                            </a></li>
                                            <li><a class="option-link multi-select-op" href="#">
                                                <label>
                                                    <input name='options[]' checked type="checkbox" class="option justone" value="FEBRERO"/> 
                                                   FEBRERO
                                                    </label>
                                                </a></li>
                                                <li><a class="option-link multi-select-op" href="#">
                                                    <label>
                                                        <input name='options[]' checked type="checkbox" class="option justone" value="MARZO"/> 
                                                       MARZO
                                                        </label>
                                                    </a></li>
                                                    <li><a class="option-link multi-select-op" href="#">
                                                        <label>
                                                            <input name='options[]' checked type="checkbox" class="option justone" value="ABRIL"/> 
                                                           ABRIL
                                                            </label>
                                                        </a></li>
                                                        <li><a class="option-link multi-select-op" href="#">
                                                            <label>
                                                                <input name='options[]' checked type="checkbox" class="option justone" value="MAYO"/> 
                                                               MAYO
                                                                </label>
                                                            </a></li>
                                                            <li><a class="option-link multi-select-op" href="#">
                                                                <label>
                                                                    <input name='options[]' checked type="checkbox" class="option justone" value="JUNIO"/> 
                                                                   JUNIO
                                                                    </label>
                                                                </a></li>
                                                                <li><a class="option-link multi-select-op" href="#">
                                                                    <label>
                                                                        <input name='options[]' checked type="checkbox" class="option justone" value="JULIO"/> 
                                                                       JULIO
                                                                        </label>
                                                                    </a></li>
                                                                    <li><a class="option-link multi-select-op" href="#">
                                                                        <label>
                                                                            <input name='options[]' checked type="checkbox" class="option justone" value="AGOSTO"/> 
                                                                           AGOSTO
                                                                            </label>
                                                                        </a></li>
                                                                        <li><a class="option-link multi-select-op" href="#">
                                                                            <label>
                                                                                <input name='options[]' checked type="checkbox" class="option justone" value="SEPTIEMBRE"/> 
                                                                               SEPTIEMBRE
                                                                                </label>
                                                                            </a></li>
                                                                            <li><a class="option-link multi-select-op" href="#">
                                                                                <label>
                                                                                    <input name='options[]' checked type="checkbox" class="option justone" value="OCTUBRE"/> 
                                                                                   OCTUBRE
                                                                                    </label>
                                                                                </a></li>
                                                                                <li><a class="option-link multi-select-op" href="#">
                                                                                    <label>
                                                                                        <input name='options[]' checked type="checkbox" class="option justone" value="NOVIEMBRE"/> 
                                                                                       NOVIEMBRE
                                                                                        </label>
                                                                                    </a></li>
                                                                                    <li><a class="option-link multi-select-op" href="#">
                                                                                        <label>
                                                                                            <input name='options[]' checked type="checkbox" class="option justone" value="DICIEMBRE"/> 
                                                                                           DICIEMBRE
                                                                                            </label>
                                                                                        </a></li>
                                   
                                    </ul>
                                </div>
                            </div>
                        </div>    
                    </div>
                        <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm text-right">Hasta:</label>
                        <div class="col-sm-4">
                        <input id="ffin" type="date" class="form-control form-control-sm " name="ffin" value ="{{date('Y-m-d')}}">
                        <input id="fhoy" type="date" class="form-control form-control-sm " name="fhoy" value ="{{date('Y-m-d')}}">
                        </div>
                    </div>
                </div>
            </div>
                  

                    <div class="mb-3 row">
                        <div class="col-md-12 d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary mx-2" name="gen" value="ver">
                                {{ __('Ver') }} <i class="fas fa-bullseye"></i>
                            </button>
                         
                        </div>
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
