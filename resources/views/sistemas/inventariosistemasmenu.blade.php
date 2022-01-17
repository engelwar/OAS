@extends('layouts.app')
@section('title', 'Inicio')
@section('content') 

@if(isset($mensaje))
<div class="modal" id="myModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content text-light" style="background-color: #ff585b; box-shadow: 10px 11px 5px 0px rgba(0,0,0,0.75);" >
      <div class="modal-header d-flex justify-content-center border-0">
        <img>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
        
        <p style="font-family: 'Satisfy', cursive; font-size: 1.3rem;">{{'"'.$mensaje.'"'}}</p>
        <div class="text-right" style="font-family: 'Satisfy', cursive; font-size: 1.1rem; "><p>{{$autor}}</p></div>
      </div>
    </div>
  </div>
</div>
@endif
<div class="wrapper border">
  @include('layouts.lateralbar')
    <div class="container w-75 p-5">
      <div class="row text-primary">
        <h2>REGISTRAR</h2>
      </div>
      <div class="row d-flex p-4 border rounded">

          <div class="col-lg-3  col-md-6 col-sm-6 col-xs-6 w-100 py-2 px-4 border-dark">
            <a href="{{route('inventariosistemas.create', 1)}}" style="text-decoration: none;">
              <div class="card imc h-100 border text-center" style="background-color: #fff;">    
                <div class="container d-flex justify-content-center px-0">
                  <img class="card-img-top"  src="{{ asset('imagenes/forms/3.jpg') }}" alt="img">
                </div>
                <div class="card-body px-2 py-2">
                  <p class="mb-0 " style="overflow: hidden;">PC</p>
                </div>
              </div>
            </a>
          </div> 
        <div class="col-lg-3  col-md-6 col-sm-6 col-xs-6 w-100 py-2 px-4 border-dark">
          <a href="{{route('inventariocelular.create')}}" style="text-decoration: none;">
            <div class="card imc h-100 border text-center" style="background-color: #fff;">    
              <div class="container d-flex justify-content-center px-0">
                <img class="card-img-top"  src="{{ asset('imagenes/forms/1.jpg') }}" alt="img">
              </div>
              <div class="card-body px-2 py-2">
                <p class="mb-0 " style="overflow: hidden;">CELULAR</p>
              </div>
            </div>
          </a>
        </div> 
        @if(Auth::user()->authorizePermisos(['materialfaltante_p_form'])||Auth::user()->authorizePermisos(['materialfaltante_form']))
        <div class="col-lg-3  col-md-6 col-sm-6 col-xs-6 w-100 py-2 px-4 border-dark">
          <a href="{{route('inventariodispositivos.create')}}" style="text-decoration: none;">
            <div class="card imc h-100 border text-center" style="background-color: #fff;">    
              <div class="container d-flex justify-content-center px-0">
                <img class="card-img-top"  src="{{ asset('imagenes/forms/2.jpg') }}" alt="img">
              </div>
              <div class="card-body px-2 py-2">
                <p class="mb-0 " style="overflow: hidden;">DISPOSITIVO</p>
              </div>
            </div>
          </a>
        </div> 
        @endif
      </div> 
    </div>
</div>
@endsection
@section('mis_scripts')
<script type="text/javascript">
    $(window).on('load',function(){
        $('#myModal').modal('show');
    });
</script>
@endsection