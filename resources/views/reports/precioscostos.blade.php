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
   
    <form method="POST" action="{{ route('precioscostos.store') }}">
    @csrf
        <div class=" row d-flex justify-content-center my-3">
            <div class="d-flex align-items-center justify-content-center">
                <h3 class="text-primary">PRECIOS</h3>
            </div>
        </div>
        <div class="row justify-content-center m-3">
            <div class="col-4">  
                <div class="row d-flex justify-content-center">
                    <h5>FILTROS</h5>
                    <div class="col-12">
                        <div class="mb-2 row d-flex justify-content-center">
                            <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm text-right">Fecha Al:</label>
                            <div class="col-sm-6">
                            <input id="ffin" type="date" class="form-control form-control-sm " name="ffin" value ="{{date('Y-m-d')}}">
                            </div>
                        </div>   
                    </div>
                </div>                
            </div>
            <div class="col-4" id="lista">
                <h5>LISTA DE PRECIOS</h5>
                <div class="px-2 overflow-auto border rounded" style="height:300px">
                <div class="form-check">
                    <label>
                        <input type="checkbox" class="selectall" />
                        TODOS
                    </label>
                </div>
                <div class="col
@if(!Auth::user()->tienePermiso(12,11))
    d-none
    
@endif">
@foreach($loc_lis as $loc =>$lista)

@if ($loc=="CASA MATRIZ")
<div class="form-check fw-bold">{{$loc}}</div>
@foreach($lista as $lis)
<div class="form-check">
    <label>
      
            

        <input name='lis_options[]' type="checkbox" class="option justone" value='{{$lis->vtLisDesc}}'
        
        /> 
            {{$lis->vtLisDesc}}

            
    </label>
</div>
@endforeach
@endif
@if ($loc=="BALLIVIAN")
<div class="form-check fw-bold">{{$loc}}</div>
@foreach($lista as $lis)
<div class="form-check">
    <label>
      
            

        <input name='lis_options[]' type="checkbox" class="option justone" value='{{$lis->vtLisDesc}}'
        
        /> 
            {{$lis->vtLisDesc}}

            
    </label>
</div>
@endforeach
@endif
@if ($loc=="HANDAL")
<div class="form-check fw-bold">{{$loc}}</div>
@foreach($lista as $lis)
<div class="form-check">
    <label>
      
            

        <input name='lis_options[]' type="checkbox" class="option justone" value='{{$lis->vtLisDesc}}'
        
        /> 
            {{$lis->vtLisDesc}}

            
    </label>
</div>
@endforeach
@endif
@if ($loc=="CALACOTO")
<div class="form-check fw-bold">{{$loc}}</div>
@foreach($lista as $lis)
<div class="form-check">
    <label>
      
            

        <input name='lis_options[]' type="checkbox" class="option justone" value='{{$lis->vtLisDesc}}'
        
        /> 
            {{$lis->vtLisDesc}}

            
    </label>
</div>
@endforeach
@endif
@if ($loc=="SANTA CRUZ")
<div class="form-check fw-bold">{{$loc}}</div>
@foreach($lista as $lis)
<div class="form-check">
    <label>
      
            

        <input name='lis_options[]' type="checkbox" class="option justone" value='{{$lis->vtLisDesc}}'
        
        /> 
            {{$lis->vtLisDesc}}

            
    </label>
</div>
@endforeach
@endif
@if ($loc=="REGIONALES")
<div class="form-check fw-bold">{{$loc}}</div>
@foreach($lista as $lis)
<div class="form-check">
    <label>
      
            

        <input name='lis_options[]' type="checkbox" class="option justone" value='{{$lis->vtLisDesc}}'
        
        /> 
            {{$lis->vtLisDesc}}

            
    </label>
</div>
@endforeach
@endif
@if ($loc=="SAN MIGUEL")
<div class="form-check fw-bold">{{$loc}}</div>
@foreach($lista as $lis)
<div class="form-check">
    <label>
      
            

        <input name='lis_options[]' type="checkbox" class="option justone" value='{{$lis->vtLisDesc}}'
        
        /> 
            {{$lis->vtLisDesc}}

            
    </label>
</div>
@endforeach
@endif
@endforeach
</div>
             
                </div>
            </div>
         
        </div>
        <div class="controles-form">
            <button type="submit" class="btn btn-primary mx-2" name="gen" value="export">
                PDF <i class="fas fa-file-pdf"></i>
            </button>
            <button type="submit" class="btn btn-primary mx-2" name="gen" value="ver">
                Ver <i class="fas fa-bullseye"></i>
            </button>
            <button type="submit" class="btn btn-primary mx-2" name="gen" value="excel">
                Excel <i class="far fa-file-excel"></i>
            </button>
        </div>





      <!---->
      <div class="controles-form-esq-der  @if(!Auth::user()->tienePermiso(5,9,)) d-none @endif">
        <!-- <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
             <i class="fas fa-tools"></i>
         </button-->

         <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
             <i class="fa fa-cog" aria-hidden="true"></i>
         </button>

     </div>


<!--datos de almacenes-->

<div class="col-8
@if(!Auth::user()->tienePermiso(5,9))
d-none
@endif">



<!--boton inferior-->          
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
<div class="offcanvas-header">
<h5 id="offcanvasRightLabel">Configuracion</h5>
<button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
</div>
<div class="offcanvas-body">
<div class="row">
<div class="col-4">
<div class="modal-body">

<div class="list-group" style="height:450px;overflow:auto; width: 125px;overflow:auto;   font-size:0.8rem">
 @foreach (App\User::get() as $u)
     <a href="#" class="list-group-item list-group-item-action usuarios_param" id = "{{$u->id}}">
         {{$u->perfiles->nombre}}
         {{$u->perfiles->paterno}}
     </a>
     
 @endforeach
</div>
</div>
</div>

</div>
<br>
<div class="modal-footer">
<button type="button" class="btn btn-sm btn-primary" id="liveToastBtn">Guardar</button>

</div>
</div>
</div>
<!--------------------->



    </form>
</div>

@endsection
@section('mis_scripts')
<script>
$( ".dropdown-menu" ).click(function() {
    $('.dropdown-menu').parent().is(".open") && e.stopPropagation();
});

$('#lista .selectall').click(function() {
    if ($(this).is(':checked')) {
        $('#lista .option').prop('checked', true);
        var total = $('#lista input[name="options[]"]:checked').length;
        $("#lista .dropdown-text").html('(' + total + ') Selected');
        $("#lista .select-text").html('(TODOS)');
    } else {
        $('#lista .option').prop('checked', false);
        $("#lista .dropdown-text").html('(0) Selected');
        $("#lista .select-text").html('');
    }
});

$('#almacen .selectall').click(function() {
    if ($(this).is(':checked')) {
        $('#almacen .option').prop('checked', true);
        var total = $('#almacen input[name="options[]"]:checked').length;
        $("#almacen .dropdown-text").html('(' + total + ') Selected');
        $("#almacen .select-text").html('(TODOS)');
    } else {
        $('#almacen .option').prop('checked', false);
        $("#almacen .dropdown-text").html('(0) Selected');
        $("#almacen .select-text").html('');
    }
});
</script>
@endsection
