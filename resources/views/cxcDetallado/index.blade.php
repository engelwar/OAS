@extends('layouts.app')
@section('static', 'statick-side')
@section('estilo')
 <style>
    
 </style>
@endsection
@section('content')
@include('layouts.sidebar', ['hide'=>'1']) 


<div class="container">
    <div class="row justify-content-center mt-4">
        <div class="col-md-8 col-lg-6 col-sm-12 border">
        
                
           
                
                <div class=" row d-flex justify-content-center my-3">
                    <div class="d-flex align-items-center justify-content-center">
                        <h3 class="text-primary">CUENTAS POR COBRAR DETALLADO</h3>
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
                    
                    <!-- en esta parte es para los filtros para ser portados en pdf y excel-->
                </div>
            </div>
            <br>
            <div class="mb-3 row">
               
                <div class="col-md-12 d-flex justify-content-center">
                    <form method="GET"  action="{{ route('CxcDetallado.store') }}">
                  <button type="submit" class="btn btn-primary mx-2" name="gen" value="ver">
                    Ver <i class="fas fa-bullseye"></i>
                  </button>
                    <button type="submit" class="btn btn-primary mx-2" name="gen" value="export">
                        PDF <i class="fas fa-file-pdf"></i>
                    </button>
                     <button type="submit" class="btn btn-primary mx-2" name="gen" value="excel">
                        Excel <i class="far fa-file-excel"></i>
                    </button>
                    </form>
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







</script>
@endsection
